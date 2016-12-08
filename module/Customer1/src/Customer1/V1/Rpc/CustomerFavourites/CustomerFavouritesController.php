<?php
namespace Customer1\V1\Rpc\CustomerFavourites;

use Common\Tools\Util;
use Customer1\V1\Model\CustomerLike;
use Zend\Mvc\Controller\AbstractActionController;
use Application\Auth\User;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;


class CustomerFavouritesController extends AbstractActionController
{
    public function customerFavouritesAction()
    {
        $customerId = $this->getEvent()->getRouteMatch()->getParam('customer_id');

        // checking customer status
        // user validation
        $user = User::getInfo();

        if (!$user) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }

        if ($user['customer_id'] != $customerId) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }

        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
       // $customer_merchant_likes_obj = new CustomerLike($this->getServiceLocator());
       // $merchant_likes = $customer_merchant_likes_obj->getUserMerchantLikes($customerId);
      //  $deal_likes = $customer_merchant_likes_obj->getUserDealLikes($customerId);
      //  return array_merge($merchant_likes, $deal_likes);
        $sql       = "select  gm.id as global_merchant_id, ml.timestamp,
						gm.name as name,gm.image_url as image_url , gm.image_big_url,  gm.dollar_range, gm.categories,
						gm.display_address1 as display_address1,gm.display_address2 as display_address2,gm.display_address3 as display_address3
                        from  customer_merchant_likes as ml
                        join global_merchant as gm on gm.id=ml.global_merchant_id
                        where ml.customer_id=$customerId
                        order by ml.timestamp DESC";
        $statement = $adapter->createStatement($sql, []);
        $results    = $statement->execute();
        $result = array();
        $result['total'] = count($results);
        foreach($results as $row){
            if($row['timestamp']){
                $row['timestamp'] = Util::timeElapsedString($row['timestamp']);
            }
            $list = [];
            $categories = json_decode($row['categories'], true);
            foreach ($categories as $category) {
                $list[] = $category[0];
            }

            $row['categories']= $list;
            $result['favourites'][] = $row;
        }

        // $result = array("count"=>count($result))+$result;
        return $result;
    }
}
