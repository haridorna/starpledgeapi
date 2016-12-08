<?php
/**
 * Created by PhpStorm.
 * User: rajesh
 * Date: 2/26/2016
 * Time: 4:25 PM
 */

namespace Common\V1\Model;

class WebsiteInfo {

    private $serviceLocator;

    private $adapter;

    private $websiteName;

    private $supportName;

    private $privmeCustomerUrl;

    private $privmeMerchantUrl;

    private $privmeAdminEmail;

    private $privmeSupportEmail;


    public function __construct($serviceLocator){
        $this->serviceLocator = $serviceLocator;
        $this->adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $config = $this->serviceLocator->get('config');
        $this->privmeCustomerUrl = $config['url']['portal_url'];
        $this->privmeMerchantUrl = $config['url']['biz_url'];
        $this->websiteName       = $config['name']['website_name'];
        $this->privmeAdminEmail  = $config['email']['admin'];
        $this->privmeSupportEmail= $config['email']['support'];
        $this->supportName       = $config['name']['support_name'];
    }

    public function getWebsiteName(){
        return $this->websiteName;
    }

    public function getPrivmeCustomerUrl(){
        return $this->privmeCustomerUrl;
    }

    public function getPrivmeMerchantUrl(){
        return $this->privmeMerchantUrl;
    }

    public function getPrivmeAdminEmail(){
        return $this->privmeAdminEmail;
    }

    public function getPrivmeSupportEmail(){
        return $this->privmeSupportEmail;
    }

    public function getAllUrlAndEmailData(){
        return [
            'customer_url'=>$this->privmeCustomerUrl,
            'merchant_url'=> $this->privmeMerchantUrl,
            'website_name'=> $this->websiteName,
            'support_email'=>$this->privmeSupportEmail,
            'admin_email'=>$this->privmeAdminEmail,
            'support_name'=>$this->supportName
        ];
    }
}