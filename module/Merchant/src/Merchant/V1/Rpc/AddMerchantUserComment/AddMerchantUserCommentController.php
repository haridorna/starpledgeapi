<?php
namespace Merchant\V1\Rpc\AddMerchantUserComment;

use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

class AddMerchantUserCommentController extends AbstractActionController
{
    public function addMerchantUserCommentAction()
    {
        $content = $this->getRequest()->getContent();
        $content = json_decode($content);
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('merchant_user_comments', $adapter);
        $result = $gateway->insert([
            'customer_id' => $content->customer_id,
            'merchant_user_id' => $content->merchant_user_id,
			'merchant_id' => $content->merchant_id,
            'comment' => $content->comment
        ]);

        if ($result) {
            $result  = $gateway->select(['id' => $gateway->lastInsertValue])->current();

            return [
                'result' => 'success',
                'message' => 'Comment successfully updated',
                'record' => $result
            ];
        }

        return new ApiProblemResponse(new ApiProblem(400, 'Sorry, Unable to update comment'));

    }
}
