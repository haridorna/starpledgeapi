<?php
namespace Customer\V1\Rpc\CheckCustomer;

use Application\Auth\AuthorizationListener;
use Application\Auth\Cipher;
use Common\Tools\Util;
use Customer\V1\Model\Dashboard\DashboardData;
use Zend\Db\TableGateway\TableGateway;
use Zend\EventManager\EventManager;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;

use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

class CheckCustomerController extends AbstractActionController
{

    public function checkCustomerAction()
    {
        $request = $this->getRequest();
        if($request->isGet()){
            $data = json_decode($request->getContent(), true);
            $headers        = $this->getServiceLocator()->get('Request')->getHeaders();
            $privPassHeader = $headers->get('X-STAR-PLEDGE');
            $token        = $privPassHeader->getFieldValue();

           // $token = $data['token'];
            $cipherObj =  new Cipher();
            $key = json_decode($cipherObj->decrypt($token), true);
            if(isset($key['customer_id'])){
                $customer_id = $key['customer_id'];
                $dashboardObj =  new DashboardData($this->getServiceLocator());
                $dashboardData = $dashboardObj->getData($customer_id);

                $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
                $customerObj = new TableGateway('customer', $adapter);
                $result = $customerObj->select(['id'=>$customer_id]);
                if($result->count()){
                    $customer = $result->current()->getArrayCopy();
                    unset($customer['password'], $customer['salt']);
                    $customer['current_privypass_score']  = $dashboardObj->getPrivpassScore($customer_id);
                    if($customer['password_updated']) $customer['password_updated'] = Util::timeElapsedString($customer['password_updated']);
                    unset($customer['previous_privypass_score']);
                }else{
                    return new ApiProblemResponse(new ApiProblem(405, "Customer Details is not available"));
                }
                return[
                    'result' => 'authenticated',
                    'status' => '200',
                    'customer' => $customer,
                    'dashboard'=> $dashboardData,
                    "no_of_accounts" => count($dashboardData['Accounts'])
                   // 'api_token' => $token
                ];
            }else{
                return new ApiProblemResponse(new ApiProblem(405, "customer not found"));
            }
        }else{
            return new ApiProblemResponse(new ApiProblem(405, "User not found"));
        }
    }
}
