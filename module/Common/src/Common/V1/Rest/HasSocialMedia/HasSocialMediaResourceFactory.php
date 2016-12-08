<?php
namespace Common\V1\Rest\HasSocialMedia;

use Zend\Db\TableGateway\TableGateway;

/**
 * Class HasSocialMediaResourceFactory
 *
 * @package Common\V1\Rest\HasSocialMedia
 * @author  Hari
 * @date    4 Jun 2014
 */
class HasSocialMediaResourceFactory
{
    public function __invoke($services)
    {
        $adapter = $services->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('has_social_media', $adapter);

        $mapper = new HasSocialMediaMapper($adapter, $gateway);

        return new HasSocialMediaResource($mapper);
    }
}
