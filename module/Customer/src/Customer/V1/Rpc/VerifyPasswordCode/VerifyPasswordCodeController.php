<?php
namespace Customer\V1\Rpc\VerifyPasswordCode;

use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

class VerifyPasswordCodeController extends AbstractActionController
{
    public function verifyPasswordCodeAction()
    {
        $module                = $this->getEvent()->getRouteMatch()->getParam('module');
        $email                 = $this->getEvent()->getRouteMatch()->getParam('email');
        $emailVerificationCode = $this->getEvent()->getRouteMatch()->getParam('email_verification_code');

        if ($module == 'customer') {
            $result = $this->verifyCustomerPasswordCode($email, $emailVerificationCode);
        } else if ($module == 'merchant') {
            $result = $this->verifyMerchantPasswordCode($email, $emailVerificationCode);
        } else {
            return new ApiProblemResponse(new ApiProblem(401, 'Invalid request'));
        }

        if (!$result) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized code'));
        }

        return $result;
    }

    private function verifyCustomerPasswordCode($email, $emailVerificationCode)
    {
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        $sql = "SELECT id, email, email_verification_code FROM customer
                WHERE email_verification_code=?
                AND email=?";

        $statement = $adapter->createStatement($sql, [$emailVerificationCode, $email]);
        $result    = $statement->execute();

        if ($result->count() > 0) {
            // Now delete the email verification code
            $sql       = "UPDATE customer SET email_verification_code='' WHERE email=?";
            $statement = $adapter->createStatement($sql, [$email]);
            $statement->execute();

            return [
                "result"  => "success",
                "message" => "Successfully verified email",
                "detail"  => $result->current()
            ];
        }
    }

    private function verifyMerchantPasswordCode($email, $emailVerificationCode)
    {
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        $sql = "SELECT id, email, password_verification_code FROM merchant_user
                WHERE password_verification_code=?
                AND email=?";

        $statement = $adapter->createStatement($sql, [$emailVerificationCode, $email]);
        $result    = $statement->execute();

        if ($result->count() > 0) {
            // Now delete the email verification code
            $sql       = "UPDATE merchant_user SET password_verification_code='' WHERE email=?";
            $statement = $adapter->createStatement($sql, [$email]);
            $statement->execute();

            return [
                "result"  => "success",
                "message" => "Successfully verified email",
                "detail"  => $result->current()
            ];
        }
    }
}
