<?php
/**
 * Author: hari
 * Date: 6/20/2015
 * Time: 1:02 AM
 */

namespace Admin\Model;


class MerchantMap
{
    private $serviceLocator;

    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function getBankList()
    {
        $sql = "SELECT DISTINCT (a.bankId) AS bank_id,
                (
                    SELECT b.bankName
                    FROM intuit_bank b
                    WHERE b.bankId=bank_id
                ) AS bank_name,
                (
                    SELECT COUNT(distinct c.payeeName)
                    FROM intuit_customer_transaction c
                    WHERE c.bankId=bank_id
                    AND c.categoryFlag = 1
                    AND c.ignoreFlag != 1
                    AND c.globalMerchantId IS NULL
					AND c.ignoreFlag != 1
                ) AS count FROM intuit_customer_account a";

        $adapter   = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $statement = $adapter->createStatement($sql, []);

        $result = $statement->execute();
        $data = [];

        foreach ($result as $item) {
            $data[] = $item;
        }

        return $data;
    }

    public function getCategoriesByBank($bankId)
    {
        $sql = "SELECT purchaseCategory, count(distinct payeeName) as categoryCount
                FROM intuit_customer_transaction
                WHERE bankId=:bankId and categoryFlag = 1 and globalMerchantId IS NULL AND ignoreFlag != 1
                AND payeeName NOT IN(SELECT DISTINCT(description) FROM merchant_description_map WHERE bank_id=:bank_id)

                GROUP BY purchaseCategory
                ORDER BY categoryCount DESC";

        $adapter   = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $statement = $adapter->createStatement($sql, ['bankId' => $bankId , 'bank_id' => $bankId ]);

        $result = $statement->execute();

        return $result;
    }

    public function getDescriptions($bankId, $categoryName)
    {
        $data = [
            'bankId' => $bankId,
            'bankId1' => $bankId
        ];

        $sql = "SELECT DISTINCT(payeeName)
                FROM intuit_customer_transaction
                WHERE globalMerchantId IS NULL 
                AND bankId=:bankId ";

        if ($categoryName == 'No Category') {
            $sql .= "AND ( purchaseCategory IS NULL OR  purchaseCategory='' )";
        } else  {
            $sql .= "AND purchaseCategory=:categoryName" ;
            $data['categoryName'] = $categoryName;
        }

        $sql .=  " AND ignoreFlag != 1
                AND payeeName NOT IN(
                    SELECT DISTINCT(description) 
                    FROM merchant_description_map
                    WHERE bank_id=:bankId1
                )";

        $adapter   = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $statement = $adapter->createStatement($sql, $data);

        $result = $statement->execute();

        $descriptions = [];

        foreach ($result as $item) {
            $descriptions[] = $item["payeeName"];
        }

        return $descriptions;
    }

}