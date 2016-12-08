<?php
namespace Customer\V1\Rpc\CreateEmailVerificationCode;

use Application\Auth\Cipher;
use Common\V1\Model\Mail\Mandrill\Mail;
use Common\V1\Model\Mail\Mandrill\Message;
use Common\V1\Model\PrivpassTemplates\Templates;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

class CreateEmailVerificationCodeController extends AbstractActionController
{
    public function createEmailVerificationCodeAction()
    {
        $module = $this->getEvent()->getRouteMatch()->getParam('module');

        if ($module == 'customer') {
            $result = $this->createCustomerVerificationCode();
        } else if ($module == 'merchant') {
            $result = $this->createMerchantVerificationCode();
        } else {
            return new ApiProblemResponse(new ApiProblem(401, 'Invalid request'));
        }

        if (!$result) {
            return new ApiProblemResponse(new ApiProblem(200, "If the email entered is registered, then instructions on how to reset your password will be sent to the email Inbox, Please check the junk folder too."));
        }

        return $result;
    }

    private function createCustomerVerificationCode()
    {
        $email   = $this->getEvent()->getRouteMatch()->getParam('email');
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        $sql       = "SELECT * FROM customer WHERE email=?";
        $statement = $adapter->createStatement($sql, [$email]);
        $result    = $statement->execute();

        $customerObj = new TableGateway('customer', $adapter);


        if ($result->count() > 0) {

            $digest = json_encode([
                'rand'  => rand(),
                'date'  => date('Y-m-d H:i:s'),
                'email' => $email
            ]);

            $crypt  = new Cipher();
            $digest = $crypt->encrypt($digest);
            $row    = $result->current();

            $this->sendEmail($row, 'customer', $digest);

            $customerObj->update(['email_verification_code'=>$digest], ['id'=>$row['id']]);

            return [
                "result"  => "success",
                "message" => "If the email entered is registered, then instructions on how to reset your password will be sent to the email Inbox, Please check the junk folder too.",
                "status"  =>  200,
                "detail" => "If the email entered is registered, then instructions on how to reset your password will be sent to the email Inbox, Please check the junk folder too.",
            ];
        }

        return FALSE;
    }

    private function sendEmail($record, $userType, $digest)
    {
        if ($userType == 'customer') {
            $email     = $record['email'];
            $firstName = $record['first_name'];
            $lastName  = $record['last_name'];
            $url       = "https://www.privme.com/reset-password/$digest";
        } else if ($userType == 'merchant') {
            $email            = $record['email'];
            $firstName        = $record['first_name'];
            $lastName         = $record['last_name'];
            $url              = "https://biz.privme.com/#/reset-password/$digest";
        }

        $templateObj = new Templates();
        $bodyArray = array('email_verification_code_link'=>$url, 'first_name'=>$firstName,'last_name'=>$lastName, 'email'=>$email);
        $body = $templateObj->getEmailTemplat('reset-password.phtml', $bodyArray );

        $subject = "Reset Password";
/*        $body    = <<<HTML
Hi $firstName $lastName,
<br><br>
We received a request to reset the password associated with this e-mail address. If you made this request, please follow the instructions below.
<br><br>
Click the link below to reset your password using our secure server:
<br><br>
<a href="$url">$url</a><br>
<br><br>
If you did not request to have your password reset then reply back to this email or email directly Admin@privpass.com.
<br><br>
If clicking the link doesn't seem to work, you can copy and paste the link into your browser's address window, or retype it there. Once you have returned to Privpass.com, we will give instructions for resetting your password.
<br><br>
Thanks
<br>
PrivPASS Admin
HTML;*/

        $message = new Message();
        $message->to($email, $firstName . ' ' . $lastName)
                ->from('info@privme.com', 'PrivMe Admin')
                ->body($body)
                ->subject($subject);

        $mailer = new Mail($this->getServiceLocator());
        $mailer->sendMail($message);
    }

    private function createMerchantVerificationCode()
    {
        $email   = $this->getEvent()->getRouteMatch()->getParam('email');
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        $sql       = "SELECT * FROM merchant_user WHERE email=?";
        $statement = $adapter->createStatement($sql, [$email]);
        $result    = $statement->execute();

        if ($result->count() > 0) {
            $row    = $result->current();
            $digest = json_encode([
                'rand'  => rand(),
                'date'  => 'NOW()',
                'email' => $email
            ]);

            $crypt  = new Cipher();
            $digest = $crypt->encrypt($digest);

            $this->sendEmail($row, 'merchant', $digest);

            return [
                "result"  => "success",
                "message" => "If the email entered is registered, then instructions on how to reset your password will be sent to the email Inbox, Please check the junk folder too.",
                "status" => 200,
                "detail"=> "If the email entered is registered, then instructions on how to reset your password will be sent to the email Inbox, Please check the junk folder too.",
            ];
        }

        return FALSE;
    }
}
