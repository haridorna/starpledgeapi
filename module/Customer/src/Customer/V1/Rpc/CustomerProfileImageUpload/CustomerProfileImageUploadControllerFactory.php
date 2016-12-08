<?php
namespace Customer\V1\Rpc\CustomerProfileImageUpload;

class CustomerProfileImageUploadControllerFactory
{
    public function __invoke($controllers)
    {
        return new CustomerProfileImageUploadController();
    }
}
