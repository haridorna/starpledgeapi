<?php
namespace Customer\V1\Rpc\CustomerMerchantImageUpload;

class CustomerMerchantImageUploadControllerFactory
{
    public function __invoke($controllers)
    {
        return new CustomerMerchantImageUploadController();
    }
}
