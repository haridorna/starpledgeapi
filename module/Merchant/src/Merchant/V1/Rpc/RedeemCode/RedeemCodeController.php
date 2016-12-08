<?php
namespace Merchant\V1\Rpc\RedeemCode;

use Aws\CloudFront\Exception\Exception;
use Merchant\V1\Model\MerchantRedeemedCode;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

class RedeemCodeController extends AbstractActionController
{
    public function redeemCodeAction()
    {
        $reqObj = $this->getRequest();

        $data = json_decode($reqObj->getContent(), true);
        $code = $data['code'];
        if (!$code) {
            return new ApiProblemResponse( new ApiProblem(406, 'Code can not be null'));
        }

        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $conn = $adapter->getDriver()->getConnection();

        $conn->beginTransaction();
        /*if (!is_numeric($code)) {
            return new ApiProblemResponse(new ApiProblem(406, 'Invalid code'));

        }*/

        try{
            $redeemedObj = new MerchantRedeemedCode($this->getServiceLocator());
            $record = $redeemedObj->getDetailsByRedeemedCode($code);
            if(isset($data['custom_amount']) && $record['cashback_amount'] < $data['custom_amount'] ){
                throw new Exception("Custom amount can not be more then cashback amount to redeem.");
            }
            $result = [];
            if($data['type'] == 'deal'){
                $redeemedObj->scanRedeemedCode($code);
                // $deal = $this->getDeal($record['deal_id']);
                $result['result'] = 'success';
                $result['status'] = '200';
                $result['detail'] = "Go ahead and give deal offer to the customer";
            }elseif($data['type'] == 'cashback'){
                if(!isset($data['custom_amount']) || $data['custom_amount'] == 0 ){
                    $redeemedObj->scanRedeemedCode($code);
                    $result['result'] = 'success';
                    $result['status'] = '200';
                    $result['detail'] = "Go ahead and give $".$record['cashback_amount']." discount to the customer";
                }else{
                    $redeemedObj->scanRedeemedCode($code, $data['custom_amount']);
                    $result['result'] = 'success';
                    $result['status'] = '200';
                    $result['detail'] = "Go ahead and give $".$data['custom_amount']." discount to the customer";
                }
            }
            $conn->commit();
            return $result;
        }catch(\Exception $e){
            $conn->rollback();
            return array("result"=>'fail', 'code'=>$code, 'detail'=>$e->getMessage());
        }
    }

    public function getDeal($id)
    {
        try{
            $sql = "SELECT id, title, summary, detail,  redeem_limit, retail_price, discount
                FROM merchant_deal WHERE id= ?";

            $adapter   = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
            $statement = $adapter->createStatement($sql, array($id));

            $result = $statement->execute()->current();

            //  $data = $result->current();
            // Rajesh : adding dummy data for details and summery. Once we have proper DB data then we need to remove the two hardcoded fields
            /* $data['detail']    = 'Unlike robotic parents, a beer and a burger are a natural pair. Initiate hunger protocol with this Groupon.Choose Between Two Options
                                     $15 for $30 worth of pub food for two
                                     $30 for $60 worth of pub food for four';
             $data['summary']     = "Polk Street Pub";
             */
            return $result;
        }catch(\Exception $e){
            throw new \Exception( $e->getMessage());
        }

    }
}
