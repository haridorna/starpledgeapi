<?php
/**
 * Project: PrivyPASS.com
 * Author: Hari Dornala
 * Date: 10/22/14
 * Time: 1:40 PM
 */

namespace Admin\Model;

use Zend\Db\TableGateway\TableGateway;

class TransactionDescripiton
{
    private $serviceLocator;
    private $adapter;

    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        $this->adapter        = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
    }

    public function fetchData($bankName, $item = 'restaurants')
    {
        $sql = "SELECT DISTINCT(description), d.siteId, c.itemDisplayName AS bankName
                FROM customer_bank_transaction a
                JOIN customer_bank_item_account b ON a.itemAccountId = b.itemAccountId
                JOIN customer_bank_item c ON c.itemId = b.itemId
                JOIN customer_bank d ON d.memSiteAccId = c.memSiteAccId
                WHERE transactionType='debit' AND currencyCode='USD' AND c.itemDisplayName=? ";

        if ($item == 'restaurants') {
            $sql .= " AND a.categoryName='Restaurants/Dining'";
        } else if ($item == 'others') {
            $sql .= " AND a.categoryName!='Restaurants/Dining'";
            $sql .= " AND a.categoryName!='Uncategorized'";
        } else if ($item == 'no-category') {
            $sql .= " AND a.categoryName='Uncategorized'";
        }

        $statement = $this->adapter->createStatement($sql, [$bankName]);
        $result    = $statement->execute();
        $tData     = [];

        foreach ($result as $item) {
            $tData[] = $item;
        }

        $sql = "SELECT * FROM merchant_yodlee_map";

        $statement = $this->adapter->createStatement($sql);
        $result    = $statement->execute();
        $mapData   = [];

        foreach ($result as $item) {
            $mapData[] = $item;
        }

//        echo '<pre>'; print_r($tData); print_r($mapData);

        foreach ($tData as $tKey => $trn) {
            $description = $trn['description'];
            $description = str_replace(' ', '', $description);

            foreach ($mapData as $map) {
                $firstMatch   = FALSE;
                $secondMatch  = FALSE;
                $thirdMatch   = FALSE;
                $mappingPart1 = $map['mapping_part1'];
                $mappingPart2 = $map['mapping_part2'];
                $mappingPart3 = $map['mapping_part3'];
                $mappingPart1 = str_replace(' ', '', $mappingPart1);
                $mappingPart2 = str_replace(' ', '', $mappingPart2);
                $mappingPart3 = str_replace(' ', '', $mappingPart3);

                if (empty($mappingPart1) && empty($mappingPart2) && empty($mappingPart3)) {
                    continue;
                }

                if (!empty($mappingPart1)) {
                    if (strstr($description, $mappingPart1) !== FALSE) {
                        $firstMatch = TRUE;
                    }
                } else {
                    $firstMatch = TRUE;
                }

                if (!empty($mappingPart2)) {
                    if (strstr($description, $mappingPart2) !== FALSE) {
                        $secondMatch = TRUE;
                    }
                } else {
                    $secondMatch = TRUE;
                }

                if (!empty($mappingPart3)) {
                    if (strstr($description, $mappingPart3) !== FALSE) {
                        $thirdMatch = TRUE;
                    }
                } else {
                    $thirdMatch = TRUE;
                }

                if ($firstMatch && $secondMatch && $thirdMatch) {
                    unset($tData[$tKey]);
                }
            }
        }

//        echo '<pre>'; print_r($tData); print_r($mapData); exit;
        return array_values($tData);
    }

    public function fetchBanks($item = 'restaurants')
    {
        $sql = "SELECT c.itemDisplayName as bankName, COUNT(DISTINCT(a.description)) AS count
                FROM customer_bank_transaction a
                LEFT JOIN customer_bank_item_account b ON a.itemAccountId=b.itemAccountId
                LEFT JOIN customer_bank_item c ON b.itemId=c.itemId ";

        if ($item == 'restaurants') {
            $sql .= " WHERE a.categoryName='Restaurants/Dining'";
        } else if ($item == 'others') {
            $sql .= " WHERE a.categoryName!='Restaurants/Dining'";
            $sql .= " AND a.categoryName!='Uncategorized'";
        } else if ($item == 'no-category') {
            $sql .= " WHERE a.categoryName='Uncategorized'";
        }

        $sql .= " GROUP BY c.itemDisplayName  ORDER BY COUNT DESC";

        $statement = $this->adapter->createStatement($sql);
        $result    = $statement->execute();
        $banks     = [];

        foreach ($result as $item) {
            $banks[] = $item;
        }

        return $banks;
    }
} 