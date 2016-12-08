<?php
/**
 * Project: PrivyPASS.com
 * Author: Hari Dornala
 * Date: 10/7/14
 * Time: 1:36 PM
 */

namespace Common\V1\Model\Mail\Mandrill;

class Message
{
    public $message = array();

    public function __construct($data = FALSE)
    {
        if ($data) {
            $this->createMessage($data);
        }
    }

    private function createMessage($data)
    {
        $this->message['html']    = $data['body'];
        $this->message['subject'] = $data['subject'];

        $this->message['from_email'] = $data['from'];

        if (array_key_exists('from_name', $data)) {
            $this->message['from_name'] = $data['from_name'];
        }

        if (array_key_exists('to', $data)) {
            foreach ($data['to'] as $toEmail) {
                $this->message['to'][] = array(
                    'email' => $toEmail['email'],
                    'name'  => $toEmail['name'],
                    'type'  => 'to'
                );
            }
        }

        if (array_key_exists('cc', $data)) {
            foreach ($data['cc'] as $ccEmail) {
                $this->message['to'][] = array(
                    'email' => $ccEmail['email'],
                    'name'  => $ccEmail['name'],
                    'type'  => 'cc'
                );
            }
        }

        if (array_key_exists('bcc', $data)) {
            foreach ($data['bcc'] as $bccEmail) {
                $this->message['to'][] = array(
                    'email' => $bccEmail['email'],
                    'name'  => $bccEmail['name'],
                    'type'  => 'bcc'
                );
            }
        }

        if (array_key_exists('reply_to', $data)) {
            $this->message['headers']['Reply-To'] = $data['reply_to'];
        } else {
            $this->message['headers']['Reply-To'] = $data['from'];
        }

        if (array_key_exists('important', $data)) {
            $this->message['important'] = $data['important'];
        } else {
            $this->message['important'] = FALSE;
        }

        if (array_key_exists('recepient_id', $data)) {
            $this->message['recipient_metadata']['values']['user_id'] = $data['recepient_id'];
            $this->message['recipient_metadata']['rcpt']              = $data['to'];
        }

        if (array_key_exists('tags', $data)) {
            $this->message['tags'] = $data['tags'];
        }
    }

    public function subject($subject)
    {
        $this->message['subject'] = $subject;

        return $this;
    }

    public function body($body)
    {
        $this->message['html'] = $body;

        return $this;
    }

    public function to($email, $name = FALSE)
    {
        $this->message['to'][] = array(
            'email' => $email,
            'name'  => $name,
            'type'  => 'to'
        );

        return $this;
    }

    public function cc($email, $name = FALSE)
    {
        $this->message['to'][] = array(
            'email' => $email,
            'name'  => $name,
            'type'  => 'cc'
        );

        return $this;
    }

    public function bcc($email, $name = FALSE)
    {
        $this->message['to'][] = array(
            'email' => $email,
            'name'  => $name,
            'type'  => 'bcc'
        );

        return $this;
    }

    public function replyTo($replyTo)
    {
        $this->message['headers']['Reply-To'] = $replyTo;

        return $this;
    }

    public function from($email, $name = FALSE)
    {
        $this->message['from_email'] = $email;

        if ($name) {
            $this->message['from_name'] = $name;
        }

        return $this;
    }

    public function getMessage()
    {
        return $this->message;
    }
} 