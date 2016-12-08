<?php
/**
 * Project: PrivyPASS.com
 * Author: Hari Dornala
 * Date: 10/27/14
 * Time: 4:37 PM
 */

namespace Admin\Model;

use Common\Tools\Logger;
use Yelp\V1\Model\Scraper;
use Yelp\V1\Model\Yelp;
use Zend\Db\TableGateway\TableGateway;

class MerchantDescriptionMap
{
    const I_DONT_GO_HERE = 'I_DONT_GO_HERE';
    const WRONG_LOCATION = 'WRONG_LOCATION';
    const HIDE_THIS_BUSINESS = 'HIDE_THIS_BUSINESS';
    const NEVER_SHOW_THIS_BUSINESS = 'NEVER_SHOW_THIS_BUSINESS';


    private $serviceLocator;
    private $adapter;

    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        $this->adapter        = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
    }

    public function mapMerchant($data)
    {
        $globalMerchant = $this->getGlobalMerchantById($data->global_merchant_id);

        $merchantMap = new TableGateway('merchant_description_map', $this->adapter);

        $result = $merchantMap->select([
            "global_merchant_id" => $data->global_merchant_id,
            "mapping_part1"      => trim($data->mapping_part1),
            "mapping_part2"      => trim($data->mapping_part2),
            "mapping_part3"      => trim($data->mapping_part3),
        ]);

        // Take care of unique key constraint.
        if ($result->count() == 0) {

            $set = array(
                "global_merchant_id" => $data->global_merchant_id,
                "mapping_part1"      => trim($data->mapping_part1),
                "mapping_part2"      => trim($data->mapping_part2),
                "mapping_part3"      => trim($data->mapping_part3),
                "term"               => $data->term,
                "location"           => $data->location
            );

            if (isset($data->description)) {
                $set["description"] = $data->description;
            }

            if (isset($data->bank_id)) {
                $set['bank_id'] = $data->bank_id;
            }

            if (isset($data->category_name)) {
                $set['category_name'] = $data->category_name;
            }

            if ($globalMerchant['is_online_store'] == 1) {
                $set['display_flag'] = 0;
            }


            // if it is online store
            if(preg_match('/\\.(com|net|us)$/', strtolower($data->mapping_part1) )  || preg_match('/\\.(com|net|us)$/', strtolower($data->mapping_part2) ) || preg_match('/\\.(com|net|us)$/', strtolower($data->mapping_part3) ) ){
                $set['display_flag'] = '0';
            }


            foreach ($set as $key => $item) {
                if(!empty($item) || $item === "0") continue;
                    unset($set[$key]);
            }
            
            $merchantMap->insert($set);

            $merchantDescriptionMapId = $merchantMap->lastInsertValue;

            $mappingParts = [];
            if (trim($data->mapping_part1)) {
                $mappingParts[] = $data->mapping_part1;
            }

            if (trim($data->mapping_part2)) {
                $mappingParts[] = $data->mapping_part2;
            }

            if (trim($data->mapping_part3)) {
                $mappingParts[] = $data->mapping_part3;
            }

            if (count($mappingParts) == 0) {
                return;
            }

            $params = [];

            $sql = "UPDATE intuit_customer_transaction
                    SET globalMerchantId=:globalMerchantId, merchantDescriptionMapId=:merchantDescriptionMapId
                    WHERE payeeName LIKE :mappingParts0 ";

            $params['mappingParts0'] = '%' . $mappingParts[0] . '%';

            if (isset($mappingParts[1])) {
                $sql .= " AND payeeName LIKE :mappingParts1 ";
                $params['mappingParts1'] = '%' . $mappingParts[1] . '%';
            }

            if (isset($mappingParts[2])) {
                $sql .= " AND payeeName LIKE :mappingParts2";
                $params['mappingParts2'] = '%' . $mappingParts[2] . '%';
            }

            $params['globalMerchantId']         = $data->global_merchant_id;
            $params['merchantDescriptionMapId'] = $merchantDescriptionMapId;

            $statement = $this->adapter->createStatement($sql, $params);

            $statement->execute();
        }

//        $this->fetchOtherApisDataFromBackground($data->yelp_id);
    }

    private function fetchOtherApisDataFromBackground($yelpId)
    {
        //        Currently this functionality is not working. This needs to be re-worked and run as a background process

        //        Logger::log('Starting Background Process -- fetch Factual, Google, Yelp apis, reviews for YelpId: ' . $yelpId);
        //
        //        $config = $this->serviceLocator->get('Config');
        //        $host   = $config['api_host'];
        //        $url    = $host . '/api/globalmerchant/fetch-api-data/' . $yelpId;
        //
        //        $request = $client->createRequest('GET', $url, ['future' => TRUE]);
        //        $client->send($request)->then(function ($response) {
        //            Logger::log('Ending Background Process -- fetch Factual, Google, Yelp apis, reviews for YelpId: ' . $yelpId);
        //            Logger::log('BG Response for ' . $yelpId . ' is: ' . $response);
        //        });
    }

    public function getGlobalMerchantById($id)
    {
        $sql = "SELECT *
                FROM global_merchant
                WHERE id=?";

        $statement = $this->adapter->createStatement($sql, array($id));
        $result    = $statement->execute();

        if ($result->count() > 0) {
            $row = $result->current();

            return $row;
        } else {
            return FALSE;
        }
    }

    public function getGlobalMerchantId($yelpId)
    {
        $globalMerchant = $this->getOrCreateGlobalMerchant($yelpId);

        return $globalMerchant['id'];
    }

    public function getOrCreateGlobalMerchant($yelpId)
    {
        $globalMerchant = $this->getGlobalMerchant($yelpId);

        if (!$globalMerchant) {
            $this->createGlobalMerchant($yelpId);
            $globalMerchant = $this->getGlobalMerchant($yelpId);
        }

        return $globalMerchant;
    }

    public function getGlobalMerchant($yelpId)
    {
        $sql = "SELECT *
                FROM global_merchant
                WHERE yelp_id=?";

        $statement = $this->adapter->createStatement($sql, array($yelpId));
        $result    = $statement->execute();

        if ($result->count() > 0) {
            $row = $result->current();

            return $row;
        } else {
            return FALSE;
        }
    }

    public function createGlobalMerchant($yelpId)
    {
        $yelp         = new Yelp($this->adapter);
        $url          = 'http://api.yelp.com/v2/business/' . $yelpId;
        $yelpMerchant = $yelp->getYelpList($url, 1);

        $yelpScraper = new Scraper();
        $data        = $yelpScraper->scrape($yelpId);

        $yelpMerchant['url']             = @$data['url'];
        $yelpMerchant['working_hours']   = json_encode(@$data['working_hours']);
        $yelpMerchant['additional_info'] = json_encode(@$data['additional_info']);

        //        echo "<pre>";
        //        print_r($yelpMerchant);
        //        exit;

        $merchantId = $this->addGlobalMerchant($yelpMerchant);

        return $merchantId;
    }

    private function addGlobalMerchant($yelpMerchant)
    {
        $merchant   = new TableGateway('global_merchant', $this->adapter);
        $categories = json_encode(@$yelpMerchant['categories']);

        $set = array(
            "name"                 => @$yelpMerchant['name'],
            "yelp_id"              => @$yelpMerchant['id'],
            "url"                  => @$yelpMerchant['url'],
            "is_claimed"           => @$yelpMerchant['is_claimed'],
            "rating"               => @$yelpMerchant['rating'],
            "review_count"         => @$yelpMerchant['review_count'],
            "snippet_image_url"    => @$yelpMerchant['snippet_image_url'],
            "snippet_text"         => @$yelpMerchant['snippet_text'],
            "image_url"            => @$yelpMerchant['image_url'],
            "rating_img_url_small" => @$yelpMerchant['rating_img_url_small'],
            "rating_img_url"       => @$yelpMerchant['rating_img_url'],
            "rating_img_url_large" => @$yelpMerchant['rating_img_url_large'],
            "categories"           => $categories,
            "display_phone"        => @$yelpMerchant['display_phone'],
            "is_closed"            => @$yelpMerchant['is_closed'],
            "city"                 => @$yelpMerchant['location']['city'],
            "display_address1"     => @$yelpMerchant['location']['display_address'][0],
            "display_address2"     => @$yelpMerchant['location']['display_address'][1],
            "display_address3"     => @$yelpMerchant['location']['display_address'][2],
            "postal_code"          => @$yelpMerchant['location']['postal_code'],
            "working_hours"        => @$yelpMerchant['working_hours'],
            "additional_info"      => @$yelpMerchant['additional_info'],
            "country_code"         => @$yelpMerchant['location']['country_code'],
            "state_code"           => @$yelpMerchant['location']['state_code'],
            "latitude"             => @$yelpMerchant['location']['coordinate']['latitude'],
            "longitude"            => @$yelpMerchant['location']['coordinate']['longitude']
        );

        $result = $merchant->insert($set);

        if ($result) {
            $merchantId = $merchant->getLastInsertValue();

            foreach (@$yelpMerchant['reviews'] as $item) {
                $this->saveYelpReview($merchantId, @$yelpMerchant['id'], $item);
            }

            return $merchantId;
        }


        return FALSE;
    }

    public function saveYelpReview($globalMerchantId, $yelpId, $yelpReview)
    {
        $reviews = new TableGateway('global_merchant_reviews', $this->adapter);
        $reviews->insert([
            'global_merchant_id' => $globalMerchantId,
            'review_id'          => $yelpReview['id'],
            'yelp_id'            => $yelpId,
            'source'             => 'yelp',
            'reviewer_name'      => $yelpReview['user']['name'],
            'reviewer_image'     => $yelpReview['user']['image_url'],
            'content'            => $yelpReview['excerpt'],
            'rating'             => $yelpReview['rating'],
            'review_date'        => date('Y-m-d', $yelpReview['time_created'])
        ]);
    }

    public function getWrongMappingList()
    {
        $tbl = new TableGateway('error_merchants', $this->adapter);

        $result = $tbl->select(['mapping_flag' => self::I_DONT_GO_HERE]);

        if ($result->count() == 0) {
            return [];
        } else {
            return $result->toArray();
        }
    }

    public function getNeverShowBusinessList()
    {
        $tbl = new TableGateway('error_merchants', $this->adapter);

        $result = $tbl->select(['mapping_flag' => self::NEVER_SHOW_THIS_BUSINESS]);

        if ($result->count() == 0) {
            return [];
        } else {
            return $result->toArray();
        }
    }

    public function getWrongLocationList()
    {
        $tbl = new TableGateway('error_merchants', $this->adapter);

        $result = $tbl->select(['mapping_flag' => self::WRONG_LOCATION]);

        if ($result->count() == 0) {
            return [];
        } else {
            return $result->toArray();
        }
    }

    public function getHideBusinessList()
    {
        $tbl = new TableGateway('error_merchants', $this->adapter);

        $result = $tbl->select(['mapping_flag' => self::HIDE_THIS_BUSINESS]);

        if ($result->count() == 0) {
            return [];
        } else {
            return $result->toArray();
        }
    }
}