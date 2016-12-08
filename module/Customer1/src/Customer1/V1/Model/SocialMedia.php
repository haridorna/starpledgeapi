<?php
/**
 * Created by PhpStorm.
 * User: rajesh
 * Date: 6/26/2015
 * Time: 11:46 AM
 */
namespace Customer1\V1\Model;

use Zend\Db\Sql\Sql;
use Zend\Db\TableGateway\TableGateway;

class SocialMedia{

    private $serviceLocator;

    public function __construct($serviceLocator){

        $this->serviceLocator = $serviceLocator ;

    }
    public function getCustomerSocialMedia($customer_id){

        $adaptor = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $sqlObj = new Sql($adaptor);
        $select = $sqlObj->select();
        $select->columns(array('twitter_id','instagram_id', 'facebook_userid', 'email'));
        $select->from('customer');
        $select->where(["id"=>$customer_id]);

        $statement = $sqlObj->prepareStatementForSqlObject($select);

        $result = $statement->execute()->current();
        if($result){
            $result['facebook_userid']=  $result['facebook_userid']==NULL ? "": $result['facebook_userid'];
            $result['twitter_id'] = $result['twitter_id']==NULL? "":$result['twitter_id'];
            $result['instagram_id'] =  $result['instagram_id']==NULL? "":$result['instagram_id'];;
            unset($result['email']);
            return $result;
        }
        return [];
    }
}