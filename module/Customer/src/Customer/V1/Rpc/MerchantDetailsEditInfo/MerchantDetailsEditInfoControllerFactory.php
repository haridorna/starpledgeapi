<?php
namespace Customer\V1\Rpc\MerchantDetailsEditInfo;

class MerchantDetailsEditInfoControllerFactory
{
    public function __invoke($controllers)
    {
        return new MerchantDetailsEditInfoController();
    }
}
