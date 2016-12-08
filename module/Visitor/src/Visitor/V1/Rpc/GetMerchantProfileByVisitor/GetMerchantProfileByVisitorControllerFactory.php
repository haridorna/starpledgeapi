<?php
namespace Visitor\V1\Rpc\GetMerchantProfileByVisitor;

class GetMerchantProfileByVisitorControllerFactory
{
    public function __invoke($controllers)
    {
        return new GetMerchantProfileByVisitorController();
    }
}
