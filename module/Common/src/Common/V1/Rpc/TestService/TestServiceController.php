<?php
namespace Common\V1\Rpc\TestService;

use Zend\Mvc\Controller\AbstractActionController;
use Aws\Sqs\SqsClient;

class TestServiceController extends AbstractActionController
{
    public function testServiceAction()
    {
        return $this->awsTest();
    }

    public function awsTest()
    {
        $config = $this->getServiceLocator()->get('Config');
        $config = $config['aws'];

        $client = SqsClient::factory(array(
            'key'    => $config['key'],
            'secret' => $config['secret'],
            'region' => $config['region']
        ));

        $queueUrl = 'https://sqs.us-west-1.amazonaws.com/656488620472/transactions';

        $client->sendMessage(array(
            'QueueUrl'    => $queueUrl,
            'MessageBody' => '{"itemAccountId": "4333333333"}'
        ));

        return ['Messeage Sent'];

        $result = $client->receiveMessage(array(
            'QueueUrl' => $queueUrl,
        ));

        $queueMsg = $result->getPath('Messages');
        $messages = [];

        if (is_array($queueMsg)) {
            foreach ($queueMsg as $message) {
                // Do something with the message
                $messages[] = $message;
            }

            foreach ($messages as $message) {
                $result = $client->deleteMessage(array(
                    'QueueUrl'      => $queueUrl,
                    'ReceiptHandle' => $message['ReceiptHandle'],
                ));
            }
        }


        return $messages;
    }
}
