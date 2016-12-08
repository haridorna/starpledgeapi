<?php
namespace Merchant\V1\Rpc\GetMerchantSession;

use Zend\Mvc\Controller\AbstractActionController;

class GetMerchantSessionController extends AbstractActionController
{
    public function getMerchantSessionAction()
    {
        $data = json_decode($this->getRequest()->getContent(), true);
        $merchant_id = $data["merchant_data"]["merchant_user_id"];
        $merchant = $this->getMerchantUser($merchant_id);

        if (!$merchant) {
            $this->loginError();
            exit;
        }

        return array(
            'status' => '200',
            'merchant_user' => $merchant,
            'merchant_businesses' => $this->getMerchantDetails($merchant["id"])
        );
    }
    protected function getMerchantUser($merchant_user_id) {
        $sql = "select mu.*, mum.merchant_id from merchant_user mu, merchant_user_map mum where mu.id = mum.merchant_user_id and mu.id = " . $merchant_user_id;

        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $statement = $adapter->query($sql);
        $result = $statement->execute(array());

        if ($result->count() == 0) {
            return FALSE;
        }

        $result = $result->current();
        unset($result['salt']);
        unset($result['password']);

        return $result;
    }
    protected function getMerchantDetails($mid) {
        $sql = "select m.global_merchant_id,m.id as merchant_id, mm.level as employee_type, m.business_name,m.email, m.address1, m.address2, m.city, m.state, m.zip, gm.snippet_image_url as image_url, mu.invitation_token, (select count(*) from merchant_campaigns where merchant_id = m.id) as num_campaigns  from merchant m, merchant_user_map mm, global_merchant gm, merchant_user mu where m.id = mm.merchant_id and m.global_merchant_id = gm.id and mu.id = mm.merchant_user_id and mu.id=" . $mid;
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $statement = $adapter->query($sql);
        $result = $statement->execute(array());
        $retarr = array();
        foreach ($result as $item) {
            //$item["query"] = $sql;
            $retarr[] = $item;
        }
        return $retarr;
    }
}
