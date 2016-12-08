<?php
/**
 * Created by JetBrains PhpStorm.
 * Author: hari
 * Date: 26/12/14
 * Time: 4:52 PM
 */

namespace Console\Model;

use Aws\Sqs\SqsClient;
use Common\Tools\Logger;

/**
 * Class SQS
 *
 * Works as SQS wrapper
 *
 * @package Console\Model
 * @author  Hari Dornala
 * @date    26 Dec 2014
 */
class SQS
{
    private $serviceLocator;
    private $sqsClient;
    private $config;

    /**
     * @param $serviceLocator
     */
    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        $this->config         = $this->serviceLocator->get('Config');
        $config               = $this->config['aws'];
        $awsConfig            = array(
            'key'    => $config['key'],
            'secret' => $config['secret'],
            'region' => $config['region']
        );
        $this->sqsClient      = SqsClient::factory($awsConfig);
    }

    /**
     * Returns message in the following format
     *
     * Array
     * (
     *     [QueueUrl] => https://sqs.us-west-1.amazonaws.com/656488620472/transactions
     *     [Body] => Array
     *         (
     *             [itemAccountId] => 444444444
     *         )
     *
     *     [ReceiptHandle] => AQEBlr7ZtuybkQ7elqAinYie2qPeXmqsHMu1lZPuR5dZpSU==
     * )
     *
     * @param $queueId
     *
     * @return array|bool
     */
    public function getMessage($queueId)
    {

        $queueUrl = $this->config['sqs'][$queueId];

        if (!$queueUrl) {
            return FALSE;
        }

        $result = $this->sqsClient->receiveMessage(array(
            'QueueUrl' => $queueUrl,
        ));

        $queueMsg = $result->getPath('Messages');

        if (is_array($queueMsg)) {
            $message = $queueMsg[0];

            $receiptHandle = $message['ReceiptHandle'];
            Logger::log("SQS Message Retrieved: with URL: $queueUrl and RecieptHandle: $receiptHandle");

            return array(
                'QueueUrl'      => $queueUrl,
                'Body'          => json_decode($message['Body'], TRUE),
                'ReceiptHandle' => $receiptHandle
            );
        }

        return FALSE;
    }

    public function deleteMessage($queueId, $receiptHandle)
    {
//        if (!($queueId || $receiptHandle)) {
//            return;
//        }

        $queueUrl = $this->config['sqs'][$queueId];

//        if (!$queueUrl) {
//            return;
//        }

        $this->sqsClient->deleteMessage(array(
            'QueueUrl'      => $queueUrl,
            'ReceiptHandle' => $receiptHandle,
        ));

        Logger::log("SQS Message set for Deletion: with URL: $queueUrl and RecieptHandle: $receiptHandle");
    }

    public function addMessage($queueId, $memSiteAccId)
    {
        $queueUrl = $this->config['sqs'][$queueId];

        if (!(trim($queueId) || trim($memSiteAccId))) {
            return;
        }

        Logger::log("Request for SQS Message creation: with URL: $queueUrl and memSiteAccId: $memSiteAccId");

        $this->sqsClient->sendMessage(array(
            'QueueUrl'    => $queueUrl,
            'MessageBody' => json_encode(['memSiteAccId' => $memSiteAccId])
        ));

        Logger::log("SQS Message set for Creation: with URL: $queueUrl and memSiteAccId: $memSiteAccId");
    }
}