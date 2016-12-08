<?php
/**
 * Created by PhpStorm.
 * User: harid
 * Date: 19-Nov-15
 * Time: 2:03 AM
 */
namespace Admin\Model;


ini_set('max_execution_time', 6000);

use Common\Tools\Logger;
use Merchant\V1\Model\Yelp\Yelp;
use Zend\Db\TableGateway\TableGateway;


class BulkMerchantDescriptionMap
{
    private $serviceLocator;
    private $tblBulkUpdateMerchantDescriptionMap;
    private $objMerchantDescriptionMap;

    const MERCHANT_NOT_FOUND = 9;
    const MERCHANT_MAP_ERROR = 8;
    const YELP_FETCH_ERROR = 7;
    const MERCHANT_MAP_SUCCESS = 1;

    /**
     * @param $serviceLocator
     */
    public function __construct($serviceLocator)
    {
        $this->serviceLocator                      = $serviceLocator;
        $adapter                                   = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $this->tblBulkUpdateMerchantDescriptionMap = new TableGateway('bulk_upload_merchant_description_map', $adapter);
        $this->objMerchantDescriptionMap           = new MerchantDescriptionMap($this->serviceLocator);
    }

    public function process($limit)
    {
        $records = $this->getRecords($limit);

        $yelp = new Yelp($this->serviceLocator);
        foreach ($records as $record) {

            try {
                $yelpData = $yelp->getYelpData($record['term'], $record['location']);
            } catch (\Exception $e) {
                $message = $e->getMessage();
                $this->updateBulkUploadMerchantDescriptionMapTable($record['id'], [
                    'processed_flag'        => self::YELP_FETCH_ERROR,
                    'process_error_comment' => $message
                ]);

                Logger::log("Terminating program with error: $message");
                die("Terminating program with error: $message");
            }

            $businesses = @$yelpData['businesses'];

            if (!$businesses || !is_array($businesses) || count($businesses) == 0) {
                $this->updateBulkUploadMerchantDescriptionMapTable($record['id'], [
                    'processed_flag'        => self::MERCHANT_MAP_ERROR,
                    'process_error_comment' => 'No results from Yelp'
                ]);
                continue;
            }

            $merchant = $this->pickRightMerchant($record, $businesses);
echo json_encode($merchant) . "\n";
            if (!$merchant) {
                $this->updateBulkUploadMerchantDescriptionMapTable($record['id'], [
                    'processed_flag'        => self::MERCHANT_NOT_FOUND,
                    'process_error_comment' => 'Merchant Not found'
                ]);

                continue;
            }

            $record                     = (object)$record;
            $record->global_merchant_id = $merchant['id'];

            try {
                $this->objMerchantDescriptionMap->mapMerchant($record);
            } catch (\Exception $e) {
                $message = $e->getMessage();

                $this->updateBulkUploadMerchantDescriptionMapTable($record->id, [
                    'processed_flag'        => self::MERCHANT_MAP_ERROR,
                    'process_error_comment' => $message
                ]);
            }

            echo "Merchant successfully mapped: MerchantId: {$merchant['id']}\n";
            Logger::log("Merchant successfully mapped: MerchantId: {$merchant['id']}");

            $this->updateBulkUploadMerchantDescriptionMapTable($record->id, [
                'processed_flag' => self::MERCHANT_MAP_SUCCESS,
                'global_merchant_id' => $merchant['id']
            ]);
        }


        return ['result' => 'success'];
    }

    private function pickRightMerchant($record, $yelpData)
    {
        $location = explode(' ', $record['location']);
        echo "\n\nDB Record:\n==============================================\n{$record['term']} {$record['location']}\n========================================\n";
        Logger::log("\n\nDB Record:\n==============================================\n{$record['term']} {$record['location']}\n========================================\n");

        foreach ($yelpData as $item) {
            $displayAddress = explode(' ', $item['display_address1']);

            echo "Testing Yelp Record: {$item['name']} {$item['display_address1']}\n";
            Logger::log("Testing Yelp Record: {$item['name']} {$item['display_address1']}\n");

            if (strtolower($record['term']) == strtolower($item['name']) &&
                strtolower($displayAddress[0]) == strtolower($location[0])
            ) {
                echo "Matched: {$item['name']} {$item['display_address1']}\nFull Record:\n" . json_encode($item) . "\n";
                Logger::log("Matched: {$item['name']} {$item['display_address1']}\nFull Record:\n" . json_encode($item) . "\n");

                return $item;
            }
        }

        echo "No items matched for {$record['term']} {$record['location']}\n---------------------------------------------------------\n";
        Logger::log("No items matched for {$record['term']} {$record['location']}");

        return FALSE;
    }

    public function getRecords($limit)
    {
        $sql = "SELECT *
                FROM bulk_upload_merchant_description_map
                WHERE processed_flag = 0 LIMIT $limit";

        $adapter   = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $statement = $adapter->createStatement($sql, array());
        $result    = $statement->execute();

        $records = [];

        foreach ($result as $item) {
            $records[] = $item;
        }

        return $records;
    }

    public function updateBulkUploadMerchantDescriptionMapTable($id, $set)
    {
        $this->tblBulkUpdateMerchantDescriptionMap->update($set, ['id' => $id]);
    }
}