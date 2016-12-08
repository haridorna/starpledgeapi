<?php
/**
 * Created by PhpStorm.
 * User: hari
 * Date: 5/28/14
 * Time: 2:28 PM
 */

namespace Customer\V1\Rest\Customer;

use Common\Rest\AbstractMapper;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;
use Zend\Paginator\Adapter\DbSelect;

/**
 * Class CustomerMapper
 *
 * @package Customer\V1\Rest\Customer
 * @author  Hari
 * @date    28 May 2014
 */
class CustomerMapper extends AbstractMapper
{
    protected $table = 'customer';

    public function fetchAll()
    {
        $select = new Select('customer');
        $select->columns(array(
            'id',
            'first_name',
            'middle_name',
            'last_name',
            'address1',
            'address2',
            'gender',
            'city_id',
            'city',
            'state',
            'zip',
            'date_of_birth',
            'registration_date',
            'email',
            'mobile',
            'latitude',
            'longitude',
            'altitude',
            'email_enabled',
            'inv_mail_sent_date',
            'status',
            'last_email_sent',
            'educational_qualification',
            'occupation',
            'organization',
            'relationship'
        ));
        $paginatorAdapter = new DbSelect($select, $this->adapter);
        $collection       = new CustomerCollection($paginatorAdapter);

        return $collection;
    }

    public function fetchOne($id)
    {
        $result = $this->select(array('id' => $id));
        $result = $result->current();

        // Let us avoid some vital columns in the response!
        unset($result->salt);
        unset($result->password);

        return $result;
    }

    public function fetchByCredentials($email, $password)
    {
        $sql = "SELECT *
                FROM customer
                WHERE PASSWORD= MD5(CONCAT(salt, '$password'))
                  AND email='$email'";

        $statement = $this->adapter->query($sql);
        $result    = $statement->execute(array());

        if ($result->count() == 0) {
            return FALSE;
        }

        $result = $result->current();
        unset($result['salt']);
        unset($result['password']);

        return $result;
    }

    public function fetchByEmail($email)
    {
        $sql = "SELECT *
                FROM customer
                WHERE email='$email'";

        $statement = $this->adapter->query($sql);
        $result    = $statement->execute(array());

        $result = $result->current();

        if (is_array($result)) {
            unset($result['salt']);
            unset($result['password']);
        }

        return $result;
    }

    public function emailExists($data){
        if(count($data)>=1 && property_exists($data, 'email') && !empty($data->email)){
            return true;
        }else{
            return false;
        }
    }

    public function  passwordExists( $data){

        if(count($data)>=1 && isset($data->password) && !empty($data->password)){
            return true;
        }else{
            return false;
        }
    }

    public function getUser($id)
    {
        $result = $this->select(array('id' => $id));
        $result = $result->current();
        return $result;
    }

    function getPrivpassScore($customer_id){

        $adapter = $this->adapter;
        $tableObj = new TableGateway('customer_privypass_score', $adapter );
        $select = $tableObj->select(['customer_id'=>$customer_id])->current()->getArrayCopy();
        return $select['current_privypass_score'];

    }

}