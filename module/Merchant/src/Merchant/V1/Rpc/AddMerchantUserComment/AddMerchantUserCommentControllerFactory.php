<?php
namespace Merchant\V1\Rpc\AddMerchantUserComment;

class AddMerchantUserCommentControllerFactory
{
    public function __invoke($controllers)
    {
        return new AddMerchantUserCommentController();
    }
}
