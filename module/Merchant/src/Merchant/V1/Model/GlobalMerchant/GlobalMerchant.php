<?php
/**
 * Project: PrivyPASS.com
 * Author: Hari Dornala
 * Date: 2/12/15
 * Time: 5:24 PM
 */

namespace Merchant\V1\Model\GlobalMerchant;

use Common\Tools\Logger;
use GlobalMerchant\V1\Model\Yelp\BusinessApi;
use Merchant\V1\Model\Yelp\YelpSearch;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\Feature\RowGatewayFeature;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use GlobalMerchant\V1\Model\Google\GooglePlace;


/**
 * Class GlobalMerchant
 * @package Merchant\V1\Model\GlobalMerchant
 * @author  Hari Dornala
 * @date    12 Feb 2015
 */
class GlobalMerchant
{
    private $serviceLocator;

    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function getMerchantById($id)
    {
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $tbl = new TableGateway('global_merchant', $adapter);

        $result = $tbl->select(['id' => $id]);
        $result = $result->current()->getArrayCopy();

        $categoryList = json_decode($result['categories'], 1);
        $categories = [];

        foreach ($categoryList as $item) {
            $categories[] = $item[0];
        }

        $result['categories'] = $categories;
        $result['working_hours'] = \GuzzleHttp\json_decode($result['working_hours'], 1);
        $result['additional_info'] = \GuzzleHttp\json_decode($result['additional_info'], 1);
        $result['privileges'] = \GuzzleHttp\json_decode($result['privileges'], 1);

        $result['factual_data'] = $this->getFactualData($id);
        $result['google_place'] = $this->getGoogleData($id);
        $result['reviews'] = $this->getReviews($id);
        $result['deals'] = $this->getDeals($id);

        return $result;
    }

    public function getDeals($globalMerchantId)
    {
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $tbl = new TableGateway('merchant_deal', $adapter);
        $result = $tbl->select(['global_merchant_id' => $globalMerchantId]);

        if ($result->count() == 0) {
            return [];
        }

        return $result->toArray();
    }

    public function getReviews($globalMerchantId)
    {
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $tbl = new TableGateway('global_merchant_reviews', $adapter);
        $result = $tbl->select(['global_merchant_id' => $globalMerchantId]);

        if ($result->count() == 0) {
            return [];
        }

        return $result->toArray();
    }

    public function getFactualData($globalMerchantId)
    {
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $tbl = new TableGateway('global_merchant_factual_data', $adapter);
        $factualData = $tbl->select(['global_merchant_id' => $globalMerchantId]);

        if ($factualData->count() == 0) {
            return [];
        }

        $factualData = $factualData->current()->getArrayCopy();

        $factualData['hours'] = \GuzzleHttp\json_decode($factualData['hours'], 1);

        if (is_array($factualData)) {
            return $factualData;
        }

        return [];
    }

    public function getGoogleData($globalMerchantId)
    {
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $tbl = new TableGateway('global_merchant_factual_data', $adapter);
        $googleData = $tbl->select(['global_merchant_id' => $globalMerchantId]);

        if ($googleData->count() == 0) {
            return [];
        }

        $googleData = $googleData->current()->getArrayCopy();
        $googleData['hours'] = \GuzzleHttp\json_decode($googleData['hours'], 1);

        if (is_array($googleData)) {
            return $googleData;
        }

        return [];
    }

    public function listMerchants($page = 1, $limit = 100)
    {
        if ($limit < 1) {
            $limit = 100;
        }

        if ($page < 1) {
            $page = 1;
        }

        $page--;
        $offset = $page * $limit;

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $sql = "SELECT `global_merchant`.*
                FROM `global_merchant`
                LIMIT $limit OFFSET $offset";

        $statement = $adapter->createStatement($sql, []);
        $result = $statement->execute();

        $count = $result->count();

        if ($count > 0) {
            $merchants = [];
            foreach ($result as $item) {
                $item['additional_info'] = json_decode($item['additional_info'], 1);
                $item['categories'] = json_decode($item['categories'], 1);
                $item['working_hours'] = json_decode($item['working_hours'], 1);
                $item['privileges'] = json_decode($item['privileges'], 1);
                $merchants[] = $item;
            }

            return [
                'count' => $count,
                'merchants' => $merchants
            ];
        }

        return [
            'count' => 0,
            'merchants' => []
        ];
    }

    public function loadDataToMerchants()
    {
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $sql = "SELECT a.id, COALESCE(a.rating,0) AS yelp_rating, COALESCE(a.review_count,0) as yelp_review_count, b.place_id, COALESCE(b.rating, 0) AS google_rating
                FROM global_merchant a
                LEFT JOIN global_merchant_google_place b ON a.id = b.global_merchant_id";

        $statement = $adapter->createStatement($sql, []);
        $result = $statement->execute();

        if ($result->count() == 0) {
            return;
        }


        $googlePlace = new GooglePlace($this->serviceLocator);

        foreach ($result as $item) {
            $globalMerchant = new TableGateway('global_merchant', $adapter, new RowGatewayFeature('id'));
            $result = $globalMerchant->select(['id' => $item['id']]);
            $row = $result->current();

            if ($item['google_rating'] > 0) {
                $score = ($item['yelp_rating'] * $item['yelp_review_count'] + $item['google_rating'] * 100) / ($item['yelp_review_count'] + 100);
            } else {
                $score = ($item['yelp_rating'] * $item['yelp_review_count']) / ($item['yelp_review_count'] + 2);
            }

            $score = round($score * 2, 2);
            $row->privy_score = $score;
            $row->save();
            $googlePlace->loadDetail($item['id'], $item['place_id']);
        }
    }

    function getGlobalMerchantData($id)
    {
        $adapter = $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $globalMerchant = new TableGateway('global_merchant', $adapter, new RowGatewayFeature('id'));
        $result = $globalMerchant->select(['id' => $id]);
        if ($result->count()) {
            return $result->current();
        }
        return [];

    }

    function getGlobalMerchant($id)
    {
        $adapter = $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $globalMerchant = new TableGateway('global_merchant', $adapter);
        $result = $globalMerchant->select(['id' => $id]);
        if ($result->count()) {
            return $result->toArray();
        }
        return [];

    }

    function getGlobalMerchantCategoriesById($global_merchant_id)
    {
        $adapter = $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $query = "select
                      (select name from business_category bc where bc.id=gbc.Category1 ) as Category1 ,

                      (select name from business_category bc where bc.id=gbc.Category2 ) as Category2,

                      (select name from business_category bc where bc.id=gbc.Category3 ) as Category3

                      from global_business_categories as gbc

                      where gbc.global_merchant_id={$global_merchant_id}";

        $result = $adapter->createStatement($query)->execute();

        $categories = [];
        if ($result->count()) {
            $result = $result->current();

            if (isset($result['Category1'])) {
                $categories[] = $this->saperateCapitalLatterCategories($result['Category1']);
            }
            if (isset($result['Category2'])) {
                $categories[] = $this->saperateCapitalLatterCategories($result['Category2']);
            }
            if (isset($result['Category3'])) {
                $categories[] = $this->saperateCapitalLatterCategories($result['Category3']);
            }
            return $categories;
        }
        return [];
    }

    function saperateCapitalLatterCategories($category)
    {
        return preg_replace('/([A-Z&])/', ' $1', $category);
    }

    function getMerchantDetailsForAdditionalInfo()
    {
        $adapter = $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $globalMerchantTable = new TableGateway('global_merchant', $adapter);

        $result = $globalMerchantTable->select(function (Select $select) {
            $select->columns(
                array('id', 'yelp_id', 'url', 'additional_info')
            );
            $select->where('working_hours is null or dollar_range is null or additional_info is null')->order('id desc')->limit(10);

        });

        return $result->toArray();
    }

    function getMerchantDetailsForConversion()
    {

        $adapter = $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $query = "select m.global_merchant_id as id, gm.yelp_id, gm.url from merchant as m join global_merchant gm where m.global_merchant_id=gm.id ";
        $results = $adapter->createStatement($query)->execute();

        if ($results->count()) {
            $merchants = [];
            foreach ($results as $result) {
                $merchants[] = $result;
            }
            return $merchants;
        }

        return [];
    }

    function addImagesToGlobalMerchantImages($images, $yelp_id, $global_merchant_id)
    {

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        if (!count($images)) {
            return true;
        }
        foreach ($images as $image) {
            try {
                $data = array(
                    'image_url_thumb' => str_replace("348s", "ms", $image),
                    'image_big_url' => str_replace("348s", "o", $image),
                    'original_url' => $image,
                    'uploader_image' => "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=200",
                    'uploader_name' => "Yelp User",
                    'source' => 'Yelp',
                    'yelp_id' => $yelp_id,
                    'global_merchant_id' => $global_merchant_id,
                    'uploaded_date' => date('d/m/Y', time()),
                    'image_id' => ''
                );

                $globalMerchantImageTable = new TableGateway('global_merchant_images', $adapter);
                $globalMerchantImageTable->insert($data);
            } catch (\Exception $e) {
                Logger::log('yelp image upload issue : ' . $e->getMessage());
            }

        }
    }

    public function updateGlobalMerchantData($yelp_id, $global_merchant_id, $data)
    {
        if(isset($data['additional_info'])){
            $data['additional_info'] = json_encode($data['additional_info']);
        }

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        try {
            $globalMerchantTable = new TableGateway('global_merchant', $adapter);

            $globalMerchantTable->update($data, ['id' => $global_merchant_id]);

            return true;
        } catch (\Exception $e) {
            Logger::log('yelp image upload issue : ' . $e->getMessage());
        }

        return false;
    }

    /**
     * @summary check if merchant fall into top level category Like Restaurant, NightLife, Hotel
     * @param $global_merchant_id
     * @param $top_level_category_id
     * @return mixed
     */
    public function isCategoryExistForTopLevelCategoryForMerchant($global_merchant_id, $top_level_category_id)
    {

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $query = "select count(id) as category_count
                    from business_category
                      where id in ( select category_id from stat_global_merchant_category_unrolled where global_merchant_id={$global_merchant_id})
                        and top_level_category_id={$top_level_category_id}";
        // Logger::log("query: ".$query);
        return $adapter->createStatement($query)->execute()->current();
    }

    function addResturantBusinessData($additional_info, $global_merchant_id)
    {

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        // $additional_info_item_restauant_table =  new TableGateway("additional_item_info_restaurant", $adapter );

        $query = "INSERT INTO `additional_item_info_restaurants` (`global_merchant_id`, `item_id`, `value` ) VALUES ";

        $deleteQuery = "DELETE from `additional_item_info_restaurants` WHERE global_merchant_id=" . $global_merchant_id . " and item_id IN ";

        $deleteId = [];

        $query1 = "";
        foreach ($additional_info as $item) {

            if ($item['parameter'] == 'Takes Reservations') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= ",  ({$global_merchant_id} , 11,  $value ) ";
                $deleteId[] = 11;
            } elseif ($item['parameter'] == 'Take-out') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= ", ({$global_merchant_id} , 21,  $value ) ";
                $deleteId[] = 21;
            } elseif ($item['parameter'] == 'Accepts Credit Cards') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= " , ({$global_merchant_id} , 10,  $value ) ";
                $deleteId[] = 10;
            } elseif ($item['parameter'] == 'Parking') {
                // $value = ($item['value'] == 'No' ?  0 : 1);
                if ($item['value'] == 'Private Lot') {
                    $value = "'{$item['value']}'";
                    $query1 .= " , ({$global_merchant_id} , 27,  $value ) ";
                    $deleteId[] = 27;
                } elseif ($item['value'] == 'Street') {
                    $value = "'{$item['value']}'";
                    $query1 .= " , ({$global_merchant_id} , 26,  $value ) ";
                    $deleteId[] = 26;
                }
            } elseif ($item['parameter'] == 'Bike Parking') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= " , ({$global_merchant_id} , 131,  $value ) ";
                $deleteId[] = 131;
            } elseif ($item['parameter'] == 'Wi-Fi') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= " , ({$global_merchant_id} , 30,  $value ) ";
                $deleteId[] = 30;
            } elseif ($item['parameter'] == 'Outdoor Seating') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= " , ({$global_merchant_id} ,  8,  $value ) ";
                $deleteId[] = 8;
            } elseif ($item['parameter'] == 'Wheelchair Accessible') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= " , ({$global_merchant_id} ,  7,  $value ) ";
                $deleteId[] = 7;
            } elseif ($item['parameter'] == 'Outdoor Seating') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= " , ({$global_merchant_id} ,  8,  $value ) ";
                $deleteId[] = 8;
            } elseif ($item['parameter'] == 'Delivery') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= " , ({$global_merchant_id} ,  20,  $value ) ";
                $deleteId[] = 20;
            } elseif ($item['parameter'] == 'Good for Kids') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= " , ({$global_merchant_id} ,  4,  $value ) ";
                $deleteId[] = 4;
            } elseif ($item['parameter'] == 'Good for Groups') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= " , ({$global_merchant_id} ,  6,  $value ) ";
                $deleteId[] = 6;
            } elseif ($item['parameter'] == "Good For") {
                if ($item['value'] == "Breakfast") {
                    $value = "'Beakfast'";
                    $query1 .= " , ({$global_merchant_id} ,  129,  $value ) ";
                    $deleteId[] = 129;
                } elseif ($item['value'] == "Lunch") {
                    $value = "'Lunch'";
                    $query1 .= " , ({$global_merchant_id} ,  129,  $value ) ";
                    $deleteId[] = 129;
                } elseif ($item['value'] == "brunch") {
                    $value = "'Brunch'";
                    $query1 .= " , ({$global_merchant_id} ,  129,  $value ) ";
                    $deleteId[] = 129;
                } elseif ($item['value'] == "dinner") {
                    $value = "'Dinner'";
                    $query1 .= " , ({$global_merchant_id} ,  129,  $value ) ";
                    $deleteId[] = 129;
                }
            } elseif ($item['parameter'] == 'Good for Working') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= " , ({$global_merchant_id} ,  130,  $value ) ";
                $deleteId[] = 130;
            } elseif ($item['parameter'] == 'Caters') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= " , ({$global_merchant_id} ,  22,  $value ) ";
                $deleteId[] = 22;
            } elseif ($item['parameter'] == 'Waiter Service') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= " , ({$global_merchant_id} ,  132,  $value ) ";
                $deleteId[] = 132;
            } elseif ($item['parameter'] == 'Has TV') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= " , ({$global_merchant_id} ,  133,  $value ) ";
                $deleteId[] = 133;
            } elseif ($item['parameter'] == 'Attire') {
                // $value = ($item['value'] == 'No' ?  0 : 1);
                $value = "'{$item['value']}'";
                $query1 .= " , ({$global_merchant_id} ,  1,  $value ) ";
                $deleteId[] = 1;
            } elseif ($item['parameter'] == 'Alcohol') {
                // $value = ($item['value'] == 'No' ?  0 : 1);
                if ($item['value'] == 'Beer & Wine Only') {
                    $value = "'{$item['value']}'";
                    $query1 .= " , ({$global_merchant_id} ,  14,  $value ) ";
                    $deleteId[] = 14;
                }
                if ($item['value'] == 'Full Bar') {
                    $value = "'{$item['value']}'";
                    $query1 .= " , ({$global_merchant_id} ,  13,  $value ) ";
                    $deleteId[] = 13;
                }

            } elseif ($item['parameter'] == 'Smoking') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= " , ({$global_merchant_id} ,  31,  $value ) ";
                $deleteId[] = 31;
            } elseif ($item['parameter'] == 'Good For Dancing') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= " , ({$global_merchant_id} ,  135,  $value ) ";
                $deleteId[] = 135;
            } elseif ($item['parameter'] == 'Has Pool Table') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= " , ({$global_merchant_id} ,  158,  $value ) ";
                $deleteId[] = 158;
            } elseif ($item['parameter'] == 'Dogs Allowed') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= " , ({$global_merchant_id} ,  139,  $value ) ";
                $deleteId[] = 139;
            } elseif ($item['parameter'] == 'Accept Apple Pay') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= " , ({$global_merchant_id} ,  138,  $value ) ";
                $deleteId[] = 138;
            } elseif ($item['parameter'] == 'Accepts Bitcoin') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= " , ({$global_merchant_id} ,  157,  $value ) ";
                $deleteId[] = 157;
            } elseif ($item['parameter'] == 'Noise Level') {
                // $value = ($item['value'] == 'No' ?  0 : 1);
                if ($item['value'] == "Average") {
                    $value = "'{$item['value']}'";
                    $query1 .= " , ({$global_merchant_id} ,  136,  $value ) ";
                    $deleteId[] = 136;
                } elseif ($item['value'] == "Noisy") {
                    $value = "'{$item['value']}'";
                    $query1 .= " , ({$global_merchant_id} ,  136,  $value ) ";
                    $deleteId[] = 136;
                } elseif ($item['value'] == "Low") {
                    $value = "'{$item['value']}'";
                    $query1 .= " , ({$global_merchant_id} ,  136,  $value ) ";
                    $deleteId[] = 136;
                }
            }
        }
       
        Logger::log(" Additional Info : " . json_encode($additional_info));
        if (!empty($query1) && $query1 != "") {

            // delete the service option which is already present which is found from Yelp to prevent duplication from yelp and Fractual
            $adapter->createStatement($deleteQuery . " (  " . implode(' , ', $deleteId) . " )")->execute();

            // inserting service options found service option from Yelp
            $adapter->createStatement($query . trim($query1, ", "))->execute();

            Logger::log("insert query : " . $query . trim($query1, ", "));

            Logger::log("Delete query : " . $deleteQuery . " (  " . implode(' , ', $deleteId) . " )");

        }

    }

    function addHotelsBusinessData($additional_info, $global_merchant_id)
    {
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        // $additional_info_item_restauant_table =  new TableGateway("additional_item_info_restaurant", $adapter );

        $query = "INSERT INTO `additional_item_info_hotels` (`global_merchant_id`, `item_id`, `value` ) VALUES ";

        $deleteQuery = "DELETE from `additional_item_info_hotels` WHERE global_merchant_id=" . $global_merchant_id . " and item_id IN ";

        $deleteId = [];

        $query1 = "";
        echo "hi";
        foreach ($additional_info as $item) {
            if ($item['parameter'] == 'Accepts Credit Cards') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= ",  ({$global_merchant_id} , 145,  $value ) ";
                $deleteId[] = 145;
            }elseif ($item['parameter'] == 'Wi-Fi') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= ",  ({$global_merchant_id} , 142,  $value ) ";
                $deleteId[] = 142;
            }elseif ($item['parameter'] == 'Accepts Apple Pay') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= ",  ({$global_merchant_id} , 146,  $value ) ";
                $deleteId[] = 146;
            }elseif ($item['parameter'] == 'Accepts Bitcoin') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= ",  ({$global_merchant_id} , 156,  $value ) ";
                $deleteId[] = 156;
            }elseif ($item['parameter'] == 'Dogs Allowed') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= ",  ({$global_merchant_id} , 147,  $value ) ";
                $deleteId[] = 147;
            }elseif ($item['parameter'] == 'Wheelchair Accessible') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= ",  ({$global_merchant_id} , 154,  $value ) ";
                $deleteId[] = 154;
            }

        }

        Logger::log(" Additional Info : ".json_encode($additional_info));
        if (!empty($query1) && $query1 != "")
        {

            // delete the service option which is already present which is found from Yelp to prevent duplication from yelp and Fractual
            $adapter->createStatement($deleteQuery." (  ". implode(' , ', $deleteId) . " )")->execute();

            // inserting service options found service option from Yelp
            $adapter->createStatement($query.trim($query1, ", "))->execute();

            Logger::log("insert query : ".$query.trim($query1, ", "));

            Logger::log("Delete query : ".$deleteQuery." (  ". implode(' , ', $deleteId) . " )");

        }

    }

    function addHealthCareBusinessData($additional_info, $global_merchant_id)
    {
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        // $additional_info_item_restauant_table =  new TableGateway("additional_item_info_restaurant", $adapter );

        $query = "INSERT INTO `additional_item_info_healthcare` (`global_merchant_id`, `item_id`, `value` ) VALUES ";

        $deleteQuery = "DELETE from `additional_item_info_healthcare` WHERE global_merchant_id=" . $global_merchant_id . " and item_id IN ";

        $deleteId = [];

        $query1 = "";

        foreach ($additional_info as $item) {

            if ($item['parameter'] == 'By Appointment Only') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= ",  ({$global_merchant_id} , 143,  $value ) ";
                $deleteId[] = 143;
            } elseif ($item['parameter'] == 'Accepts Insurance') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= ",  ({$global_merchant_id} , 68,  $value ) ";
                $deleteId[] = 68;
            }
            if ($item['parameter'] == 'Accepts Credit Cards') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= ",  ({$global_merchant_id} , 161,  $value ) ";
                $deleteId[] = 161;
            } elseif ($item['parameter'] == 'Wi-Fi') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= ",  ({$global_merchant_id} , 160,  $value ) ";
                $deleteId[] = 160;
            } elseif ($item['parameter'] == 'Dogs Allowed') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= ",  ({$global_merchant_id} , 163,  $value ) ";
                $deleteId[] = 163;
            } elseif ($item['parameter'] == 'Accepts Apple Pay') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= ",  ({$global_merchant_id} , 162,  $value ) ";
                $deleteId[] = 162;
            } elseif ($item['parameter'] == 'Parking') {
                // $value = ($item['value'] == 'No' ?  0 : 1);
                if ($item['value'] == 'Private Lot') {
                    $value = "'{$item['value']}'";
                    $query1 .= " , ({$global_merchant_id} , 167,  $value ) ";
                    $deleteId[] = 167;
                } elseif ($item['value'] == 'Street') {
                    $value = "'{$item['value']}'";
                    $query1 .= " , ({$global_merchant_id} , 164,  $value ) ";
                    $deleteId[] = 164;
                } elseif ($item['value'] == 'Garage') {
                    $value = "'{$item['value']}'";
                    $query1 .= " , ({$global_merchant_id} , 165,  $value ) ";
                    $deleteId[] = 165;
                } elseif ($item['value'] == 'Valet') {
                    $value = "'{$item['value']}'";
                    $query1 .= " , ({$global_merchant_id} , 166,  $value ) ";
                    $deleteId[] = 166;
                }
            } elseif ($item['parameter'] == 'Good for Groups') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= ",  ({$global_merchant_id} , 171,  $value ) ";
                $deleteId[] = 171;
            } elseif ($item['parameter'] == 'Good for Kids') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= ",  ({$global_merchant_id} , 172,  $value ) ";
                $deleteId[] = 172;
            }  elseif ($item['parameter'] == 'Wheelchair Accessible') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= ",  ({$global_merchant_id} , 170,  $value ) ";
                $deleteId[] = 170;
            }
        }

        Logger::log(" Additional Info : ".json_encode($additional_info));
        if (!empty($query1) && $query1 != "")
        {

            // delete the service option which is already present which is found from Yelp to prevent duplication from yelp and Fractual
            $adapter->createStatement($deleteQuery." (  ". implode(' , ', $deleteId) . " )")->execute();

                // inserting service options found service option from Yelp
            $adapter->createStatement($query.trim($query1, ", "))->execute();

            Logger::log("insert query : ".$query.trim($query1, ", "));

            Logger::log("Delete query : ".$deleteQuery." (  ". implode(' , ', $deleteId) . " )");

        }
    }

    function updateMerchantDataByGlobalMerchantData($data, $global_merchant_id){

        $insertData['working_hours'] =  $data['working_hours'];
        $insertData['dollar_range'] = $data['dollar_range'];
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        try {
            $globalMerchantTable = new TableGateway('merchant', $adapter);

            $globalMerchantTable->update($insertData, ['global_merchant_id' => $global_merchant_id]);

            return true;
        } catch (\Exception $e) {
            Logger::log('yelp image upload issue : ' . $e->getMessage());
        }

        return false;
    }

    public function addOthersBusinessData($additional_info , $global_merchant_id){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        // $additional_info_item_restauant_table =  new TableGateway("additional_item_info_restaurant", $adapter );

        $query = "INSERT INTO `additional_item_info_others` (`global_merchant_id`, `item_id`, `value` ) VALUES ";

        $deleteQuery = "DELETE from `additional_item_info_others` WHERE global_merchant_id=" . $global_merchant_id . " and item_id IN ";

        $deleteId = [];

        $query1 = "";

        foreach ($additional_info as $item) {

            if ($item['parameter'] == 'By Appointment Only') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= ",  ({$global_merchant_id} , 173,  $value ) ";
                $deleteId[] = 173;
            }
            elseif ($item['parameter'] == 'Accepts Credit Cards') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= ",  ({$global_merchant_id} , 175,  $value ) ";
                $deleteId[] = 175;
            } elseif ($item['parameter'] == 'Wi-Fi') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= ",  ({$global_merchant_id} , 174,  $value ) ";
                $deleteId[] = 174;
            } elseif ($item['parameter'] == 'Dogs Allowed') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= ",  ({$global_merchant_id} , 177,  $value ) ";
                $deleteId[] = 177;
            } elseif ($item['parameter'] == 'Accepts Apple Pay') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= ",  ({$global_merchant_id} , 176,  $value ) ";
                $deleteId[] = 176;
            } elseif ($item['parameter'] == 'Parking') {
                // $value = ($item['value'] == 'No' ?  0 : 1);
                if ($item['value'] == 'Private Lot') {
                    $value = "'{$item['value']}'";
                    $query1 .= " , ({$global_merchant_id} , 181,  $value ) ";
                    $deleteId[] = 181;
                } elseif ($item['value'] == 'Street') {
                    $value = "'{$item['value']}'";
                    $query1 .= " , ({$global_merchant_id} , 178,  $value ) ";
                    $deleteId[] = 178;
                } elseif ($item['value'] == 'Garage') {
                    $value = "'{$item['value']}'";
                    $query1 .= " , ({$global_merchant_id} , 179,  $value ) ";
                    $deleteId[] = 179;
                } elseif ($item['value'] == 'Valet') {
                    $value = "'{$item['value']}'";
                    $query1 .= " , ({$global_merchant_id} , 180,  $value ) ";
                    $deleteId[] = 180;
                }
            } elseif ($item['parameter'] == 'Good for Groups') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= ",  ({$global_merchant_id} , 185,  $value ) ";
                $deleteId[] = 185;
            } elseif ($item['parameter'] == 'Wheelchair Accessible') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= ",  ({$global_merchant_id} , 184,  $value ) ";
                $deleteId[] = 184;
            }elseif ($item['parameter'] == 'Bike Parking') {
                $value = ($item['value'] == 'No' ? 0 : 1);
                $query1 .= ",  ({$global_merchant_id} , 187,  $value ) ";
                $deleteId[] = 187;
            }
        }

        Logger::log(" Additional Info : ".json_encode($additional_info));
        if (!empty($query1) && $query1 != "")
        {

            // delete the service option which is already present which is found from Yelp to prevent duplication from yelp and Fractual
            $adapter->createStatement($deleteQuery." (  ". implode(' , ', $deleteId) . " )")->execute();

            // inserting service options found service option from Yelp
            $adapter->createStatement($query.trim($query1, ", "))->execute();

            Logger::log("insert query : ".$query.trim($query1, ", "));

            Logger::log("Delete query : ".$deleteQuery." (  ". implode(' , ', $deleteId) . " )");

        }
    }

    function getYipitGlobalMerchantInfo($global_merchant_id = null){

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $query = "SELECT
                        DISTINCT gm.id as id, if(LENGTH(gm.working_hours), 1, 0) as working_hours, gm.yelp_id, gm.url, gm.name, gm.display_address1, gm.latitude, gm.longitude,
                         (select count(*) from global_merchant_reviews as gmr where gmr.global_merchant_id=gm.id) as review_count,
                         (select count(*) from global_merchant_images as gmi where gmi.global_merchant_id=gm.id) as image_count,
                         ypm.id as yipit_merchant_id
                  FROM
                        global_merchant as gm
                  JOIN
                        Yipit_com_Merchants as ypm on gm.id=ypm.globalMerchantId

                  ";
        $query = isset($global_merchant_id) ? $query." and gm.id=".$global_merchant_id : $query;
        $query .= ' ORDER BY ypm.globalMerchantId DESC';
        $results = $adapter->createStatement($query)->execute();

        $merchantInfo = [];

        if($results->count()){
            foreach($results as $result){
                $merchantInfo[] = $result;
            }
        }

        return $merchantInfo;
    }

    function fetchAndInsertReviewsAndImages($item){

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $yelpsearchObj = new YelpSearch($adapter ,$this->serviceLocator);

        try{

            $yelpObj = new BusinessApi($this->serviceLocator);
            $data    = $yelpObj->getBusinessData($item['yelp_id']);

            $reviews = @$data['reviews'];

            $reviews = is_object($reviews) ? (array)$reviews : $reviews;

            if($reviews){
                $yelpsearchObj->saveYelpReviews1($reviews, $item['id'] , $item['yelp_id']);
            }

        }catch(\Exception $e){
           Logger::log('Yelp Reviews error : '.$e->getMessage());
        }

        try {
            // Retrieve Google Place
            $google = new GooglePlace($this->serviceLocator);
            $name = $item['name'];
            $location = $item['latitude'] . ',' . $item['longitude'];
            $address1 = $item['display_address1'];
            $googlePlace = $google->searchGooglePlace($name, $location, $address1);

            if ($googlePlace) {
                $google->savePlace($googlePlace, $item['yelp_id'], $item['id']);
            }

            $reviews = @$googlePlace['reviews'];

            if ($reviews) {
                $yelpsearchObj->saveGoogleReviews1($reviews, $item['id'], $item['yelp_id'], $google);
            }
            // inserting google Images in global_merchant_image table if google photo object is available
            
            $google->insertGoogleImagesForMerchant($googlePlace, $item['yelp_id'], $item['id']);

        }catch (\Exception $e){
            Logger::log('google Reviews error : '.$e->getMessage());
        }

    }

} 