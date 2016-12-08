<?php
namespace Merchant\V1\Rest\Merchant;

use Common\Rest\AbstractMapper;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;

class MerchantMapper extends AbstractMapper
{
    protected $table = 'merchant_master';

    public function fetchAll()
    {
        $select = new Select('merchant_master');
        $select->columns(array(
            'id',
            'merchant_name',
            'first_name',
            'last_name',
            'contact_name',
            'contact_address1',
            'contact_address2',
            'contact_city_id',
            'contact_zip',
            'contact_email1',
            'contact_email2',
            'contact_phone1',
            'contact_phone2',
            'reg_date',
            'latitude',
            'longitude',
            'altitude',
            'merchant_url1',
            'merchant_url2',
            'merchant_icon_small',
            'merchant_icon_large',
            'email_enabled',
            'inv_sent_date',
            'status',
            'last_mail_sent',
            'merchant_lead_id',
            'yelp_id'
        ));
        $paginatorAdapter = new DbSelect($select, $this->adapter);
        $collection       = new MerchantCollection($paginatorAdapter);

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

    public function addBusinessCategory($merchant_id, $category_id)
    {
        $sql       = "INSERT INTO merchant_has_business_category (merchant_id, business_category_id) VALUES ({$merchant_id}, {$category_id});";
        $statement = $this->adapter->query($sql);
        $statement->execute(array());
    }

    public function deleteAllBusinessCategories($merchant_id)
    {
        $sql = "DELETE
                FROM merchant_has_business_category
                WHERE merchant_id={$merchant_id}";

        $statement = $this->adapter->query($sql);
        $statement->execute(array());
    }
}