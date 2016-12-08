<?php
/**
 * Created by PhpStorm.
 * User: rajesh
 * Date: 11/23/2015
 * Time: 4:56 PM
 */

namespace Common\V1\Model;

use Common\Tools\Logger;
use Zend\Db\TableGateway\TableGateway;


class TinyUrl {

    private $serviceLocator;
    private $adapter;

    private $url = "http://ppweb.us/";

    private $privpassCustomerUrl = "https://www.privme.com/refc/";

    private $privpassMerchantUrl = "https://www.privme.com/refm/";

    public function __construct($serviceLocator){
        $this->serviceLocator = $serviceLocator;
        $this->adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
    }

    public function isUrlUniqueCodeAvailable($code){
        $tinyUrlTable = new TableGateway('tiny_urls', $this->adapter);
        $result = $tinyUrlTable->select(["unique_chars"=>$code]);
        if($result->count()>0){
            return true;
        }
        return false;
    }

    public function insertTinyUrlTable($data){
        $tinyUrlTable = new TableGateway('tiny_urls', $this->adapter);
        try{
            $result = $tinyUrlTable->insert($data);
        }catch(\Exception $e){
            Logger::log(date('d-m-Y')." tiny_url error : ".$e->getMessage());
        }
        return true;
    }

    public function getTinyBaseUrl(){
        return $this->url;
    }

    public function getPrivpassCustomerUrl(){
        return $this->privpassCustomerUrl;
    }

    public function getPrivpassMerchantUrl(){
        return $this->privpassMerchantUrl;
    }
}