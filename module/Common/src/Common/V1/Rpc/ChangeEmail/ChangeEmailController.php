<?php
namespace Common\V1\Rpc\ChangeEmail;

use Customer\V1\Model\CustomerDetails;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

class ChangeEmailController extends AbstractActionController
{
    public function changeEmailAction()
    {
        $request = $this->getRequest();

        $code = $this->getEvent()->getRouteMatch()->getParam('code');

        $customerDetailsObj = new CustomerDetails($this->getServiceLocator());

        if($request->isPut()){

            // check if code is available
            if($code){
                try{
                    $data = $customerDetailsObj->decryptCustomerData($code);
                    $customerDetailsObj->setPrimaryEmailByDycryptData($data);
                    return array("details"=>"Your email ".$data['email']." is varified.", "code"=>200);
                }catch (\Exception $e){
                    return new ApiProblemResponse(new ApiProblem('422', $e->getMessage(), NULL , NULL, array('error'=>$e->getMessage(), 'code'=> 422)));
                }

            }else{
                $data = json_decode($request->getContent(), true);

                try{
                    if(!isset($data['user_type'])) throw new \Exception("User type is required");
                    $customerEmailStatus = $customerDetailsObj->changeEmailByUserData($data);
                    if($customerEmailStatus){
                        return array('message'=>"Please check your new email to verify your account.", "code"=>200);
                    }
                }catch(\Exception $e){
                    return new ApiProblemResponse(new ApiProblem('422', $e->getMessage(), NULL , NULL, array('error'=>$e->getMessage(), 'code'=> 422)));
                }
            }


        }
    }
}
