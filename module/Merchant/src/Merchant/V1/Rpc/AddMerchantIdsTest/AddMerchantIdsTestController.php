<?php
namespace Merchant\V1\Rpc\AddMerchantIdsTest;

use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;

class AddMerchantIdsTestController extends AbstractActionController
{
    public function addMerchantIdsTestAction()
    {
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
      //  $tableGlobalmerchant = new TableGateway("global_merchant", $adapter);

      //  $results = $tableGlobalmerchant->select()->toArray();
        $query = "select id, categories from global_merchant";
        $results = $adapter->createStatement($query)->execute();

        foreach($results as $row){
            $global_merchant_id = $row['id'];
            $categories = json_decode($row['categories']);
                $count = count($categories);
                if($count && $count==1){
                    /*$Category1_query = "select (select id from business_category where yelp_name='".$categories[0][1]."') as Category1";
                    $results = $adapter->createStatement($Category1_query)->execute()->current();
                    var_dump($results['Category1']);*/

                    $insertQuery = "insert into global_business_categories (global_merchant_id, Category1) values ";
                    $insertQuery .= "($global_merchant_id , (select id from business_category where yelp_name='".$categories[0][1]."' limit 1) )";
                   // echo $insertQuery;
                    $results = $adapter->createStatement($insertQuery )->execute();
                }elseif($count && $count==2){
                    $insertQuery = "insert into global_business_categories (global_merchant_id, Category1, Category2) values ";
                    $insertQuery .= "($global_merchant_id , (select id from business_category where yelp_name='".$categories[0][1]."' limit 1), (select id from business_category where yelp_name='".$categories[1][1]."' limit 1) )";
                    $results = $adapter->createStatement($insertQuery)->execute();
                }elseif($count && $count==3){
                    $insertQuery = "insert into global_business_categories (global_merchant_id, Category1, Category2, Category3) values ";
                    $insertQuery .= "($global_merchant_id , (select id from business_category where yelp_name='".$categories[0][1]."' limit 1), (select id from business_category where yelp_name='".$categories[1][1]."' limit 1), (select id from business_category where yelp_name='".$categories[2][1]."' limit 1 ))";
                    $results = $adapter->createStatement($insertQuery)->execute();
                }else{
                    echo "no category found for global_merchant_id = ".$global_merchant_id;
                }

        }
    }
}
