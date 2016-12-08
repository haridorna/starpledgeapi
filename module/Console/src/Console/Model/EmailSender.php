<?php
/**
 * Author: hari
 * Date: 7/28/2015
 * Time: 12:34 AM
 */

namespace Console\Model;

use Common\V1\Model\Mail\Mandrill\Mail;
use Common\V1\Model\Mail\Mandrill\Message;

class EmailSender
{
    private $serviceLocator;

    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function emailUnmappedTransactions()
    {
        $sql = "SELECT a.bankId, bankName, payeeName
                FROM intuit_customer_transaction a
                JOIN intuit_bank b ON a.bankId = b.bankId
                WHERE globalMerchantId IS NULL and ignoreFlag !=1
                GROUP BY bankId, payeeName";

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $statement = $adapter->createStatement($sql, []);

        $result = $statement->execute();

        $table ="<table>
                    <tr>
                        <th>Bank Id</th>
                        <th>Bank Name</th>
                        <th>Description</th>
                    </tr>";

        foreach ($result as $item) {
            $table .= "<tr>
                <td>{$item['bankId']}</td>
                <td>{$item['bankName']}</td>
                <td>{$item['payeeName']}</td>
            </tr>";
        }

        $table.= '</table';

        $body = "<p>
            Transactions Fetch and Mapping finished at ". date('Y-m-d H:i:s') . ".<br>
            The following is list of Unmapped Descriptions present in transactions.
        </p>";

        $body .= $table;

        $message = new Message();
        $message->to('info@privme.com', 'Admin')
            ->to('rajeshkumar@ladsolutions.com', 'Rajesh Jain')
            ->cc('sharath@ladsolutions.com', 'Sharath')
            ->from('admin@privme.com', 'Admin')
            ->subject('Unmapped Descriptions statement')
            ->body(mb_convert_encoding($body, "UTF-8"));

        $mailer = new Mail($this->serviceLocator);
        $mailer->sendMail($message);
    }
}