<?php
namespace Customer\V1\Rpc\MobileInvitation;

use Common\Tools\sendSMS;
use Common\Tools\Util;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use Application\Auth\User;
// require_once('plivo.php');
class MobileInvitationController extends AbstractActionController
{
    public function mobileInvitationAction()
    {
        $data = $this->getRequest()->getContent();
        $data = json_decode($data, TRUE);
        $mobileNumbers = $data['mobile_numbers'];

        $user = User::getInfo();

        if (!$user) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }


        if ($user['customer_id'] != $data['customer_id']) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }

        if (!is_array($mobileNumbers)) {
            return new ApiProblemResponse(new ApiProblem(400, "Mobile Numbers should be an array"));
        }

        $numbers = [];

        $smsObj = new sendSMS();
        foreach ($mobileNumbers as $key => $item) {
            $message = '';

            if (!ctype_digit($item)) {
                $message .= "Invalid Mobile Number;";
            }

            if (strlen($item) < 10 ) {
                $message .= "Mobile Number length invalid;";
            }
            if (strlen($item) == 10) {
                $item = "1".$item;
            }

            if ($message) {
                $numbers[$item] = $message;
            }

            try {
                $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
                $customerObj = new TableGateway('customer', $adapter);
                $customer = $customerObj->select(['id'=>$data['customer_id']])->current();
                $message = "You should join PrivMe! and STOP losing unclaimed Cashbacks on your purchases,use this link to unlock those EXTRA Rewards now! ".$customer['tiny_url']." ";
                /*
                $config = $this->getServiceLocator()->get('config');

                $mobileApiObj = new \RestAPI($config['api']['plivo']['auth_id'],$config['api']['plivo']['auth_token']);// RestAPI($config['api']['plivo']['auth_id'],$config['api']['plivo']['auth_token']);
                $url =  Util::tinyUrl( "http://privpass.com.");
                $params = array(
                    'src' => $config['api']['plivo']['src_no'], // Sender's phone number with country code
                    'dst' => $item, // Receiver's phone number with country code
                    'text' => 'Hi, '.$customer['first_name'].' '.$customer['last_name'].' has invited you to join: '.$url // Your SMS text message
                    // To send Unicode text
                    //'text' => 'こんにちは、元気ですか？' # Your SMS Text Message - Japanese
                    //'text' => 'Ce est texte généré aléatoirement' # Your SMS Text Message - French
                    //   'url' => 'https://glacial-harbor-8656.herokuapp.com/report', // The URL to which with the status of the message is sent
                    //  'method' => 'POST' // The method used to call the url
                );

                $response = $mobileApiObj->send_message($params);

                // echo "Response : ";
                //  print_r ($response['response']);*/



                $response = $smsObj->send($item, $message, $this->getServiceLocator());

                if (count($numbers) > 0) {
                    return new ApiProblemResponse(new ApiProblem(400, "Mobile Numbers Numeric values only ", null, null, ['messages' => $numbers]));
                }


            }catch (\Exception $e){
                return new ApiProblemResponse( new ApiProblem('405', $e->getMessage()));
            }


        }
        return [
            'result'  => 'success',
            'message' => 'SMS sent successfully'
        ];


    }
}
