<?php
namespace Customer\V1\Rpc\ChangeUserPassword;

use Aws\CloudFront\Exception\Exception;
use Customer\V1\Model\CustomerDetails;
use Zend\Mvc\Controller\AbstractActionController;

use Application\Auth\User;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

class ChangeUserPasswordController extends AbstractActionController
{
    public function changeUserPasswordAction()
    {
        $data = json_decode($this->getRequest()->getContent(), true);

        $user = User::getInfo();

        if (!$user) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }

        if ($user['customer_id'] != $data['customer_id']) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized for this request'));
        }

        $requestObj = $this->getRequest();

        if($requestObj->isPut()){

            try{
                $customerDetailsObj = new CustomerDetails($this->getServiceLocator());

                $customerDetailsObj->checkPassword($data);

                $customerDetailsObj->changePassword($data);

               return array('status'=>200, 'detail'=>'Password updated successfully');
            }catch (\Exception $e){
                return new ApiProblemResponse(new ApiProblem(422 , $e->getMessage()));
            }
        }else{
            return new ApiProblemResponse(new ApiProblem(405,  "Method not allowed"));

        }

    }
}
