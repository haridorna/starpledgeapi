<?php
namespace Common\V1\Rpc\DeviceInfoUpdate;

use Customer\V1\Model\CustomerDetails;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

class DeviceInfoUpdateController extends AbstractActionController
{
    public function deviceInfoUpdateAction()
    {
        $reqObj = $this->getRequest();

        $data = json_decode($reqObj->getContent());

        $customerDetailsObj = new CustomerDetails($this->getServiceLocator());

        if($customerDetailsObj->isAuthorisedLogin($data->customer_id)){
            throw new \Exception('Unauthorized Access');
        }

        $insertData = array(
            "deviceToken" => $data->deviceToken,
            "deviceId"    => $data->deviceId,
            "deviceOs"    => $data->deviceOs,
            "customerId"  => $data->customerId
        );

        // if device info exists
        $responseObj = new Response();

        if($reqObj->isPost()){

            if($data->context == 'customer'){
                try{
                    if($customerDetailsObj->isDeviceInfoExists($insertData)){
                        $responseObj->setStatusCode(Response::STATUS_CODE_200);
                        throw new \Exception('Device information already added');
                    }

                    if(!$customerDetailsObj->insertCustomerDeviceInfo($insertData)){
                        $responseObj->setStatusCode(Response::STATUS_CODE_422);
                        throw new \Exception('unable to add the device information.');
                    }

                    return array('status'=>200, 'details'=>"device information added successfully");

                }catch(\Exception $e){
                    return new ApiProblemResponse(new ApiProblem($responseObj->getStatusCode(), $e->getMessage()));
                }
            }else{
                return array('status'=>422, 'details'=>"type paramter is not correct");
            }
        }elseif($reqObj->isPut()){

            try{
                $insertData['customerId'] = $data->customerId;
                if($data->context == 'customer'){
                    if(!$customerDetailsObj->updateCustomerNotificationInfo($insertData)){
                        throw new \Exception('unable to Update the device information.');
                    }
                    return array('status'=>200, 'details'=>"device information updated successfully");
                }else{
                    return array('status'=>422, 'details'=>"type paramter is not correct");
                }

            }catch (\Exception $e){
                return new ApiProblemResponse(new ApiProblem(422, $e->getMessage()));
            }

        }
        exit;
    }
}
