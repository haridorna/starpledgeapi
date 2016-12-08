<?php
namespace Facebook\V1\Rpc\GetFacebookFriends;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Db\TableGateway\TableGateway;
use Application\Auth\User;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

class GetFacebookFriendsController extends AbstractActionController
{
    public function getFacebookFriendsAction()
    {
        $customerId = $this->getEvent()->getRouteMatch()->getParam('customer_id');

        // user validation
        $user = User::getInfo();

        if (!$user) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }


        if ($user['customer_id'] != $customerId) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }

        $adapter    = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $sql        = "SELECT facebook_friend_id AS id, friend_name AS name
                       FROM customer_facebook_friends
                       WHERE customer_id=?";

        $result = $adapter->query($sql, array($customerId));

        $count   = $result->count();
        $friends = $result->toArray();

        return array(
            'total'       => $count,
            'customer_id' => $customerId,
            'friends'     => $friends
        );
    }
}
