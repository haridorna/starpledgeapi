<?php
namespace Merchant\V1\Rest\MerchantUserLikes;

use Zend\Db\TableGateway\TableGateway;

class MerchantUserLikesResourceFactory
{
    public function __invoke($services)
    {
        $adapter = $services->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('merchant_user_likes', $adapter);
        return new MerchantUserLikesResource($gateway);
    }
}
