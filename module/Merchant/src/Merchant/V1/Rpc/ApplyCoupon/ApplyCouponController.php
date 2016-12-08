<?php
namespace Merchant\V1\Rpc\ApplyCoupon;

use Zend\Mvc\Controller\AbstractActionController;
use Application\Auth\User;
use ZF\ApiProblem\ApiProblemResponse;
use ZF\ApiProblem\ApiProblem;

class ApplyCouponController extends AbstractActionController
{
    public function applyCouponAction()
    {
        $user = User::getInfo();

        if (!$user) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }
        try{
            return ["status"=>"success","message"=>"Thanks. Coupon code applied successfully"];
        }catch(\Exception $e){
            return new ApiProblemResponse(new ApiProblem(402, $e->getMessage()));
        }
    }
}
