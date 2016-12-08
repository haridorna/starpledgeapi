<?php
namespace Merchant\V1\Rpc\ScanDealCode;

use Merchant\V1\Model\MerchantRedeemedCode;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use ZF\ApiProblem\View\ApiProblemRenderer;

class ScanDealCodeController extends AbstractActionController
{
    public function scanDealCodeAction()
    {


        /*if (!is_numeric($code)) {
            return new ApiProblemResponse(new ApiProblem(406, 'Invalid code'));

        }*/

        if ($this->getRequest()->isGet()) {

            try {

                $code = $this->getEvent()->getRouteMatch()->getParam('deal_code', NULL);

                if (!$code) {
                    // return new  ApiProblem(406, 'Code can not be null');
                    throw new \Exception('Deal code is required');
                }

                $redeemedObj = new MerchantRedeemedCode($this->getServiceLocator());
                $record = $redeemedObj->getDetailsByRedeemedCode($code);
                // $redeemedObj->scanRedeemedCode($code);
                $deal_type = $record['deal_id'] ? 'deal' : 'cashback';
                if ($deal_type == 'deal') {
                    $deal = $this->getDeal($record['deal_id']);
                    $deal['discount'] = round(($deal['discount'] * $deal['retail_price']) / 100, 2);
                    return [
                        'result' => 'success',
                        'type' => 'deal',
                        'code' => $code,
                        'message' => 'Deal code is successfully verified',
                        'deal' => $deal
                    ];
                } else {
                    return [
                        'result' => 'success',
                        'type' => 'cashback',
                        'code' => $code,
                        'message' => 'Cashback code is successfully verified',
                        'cashback_amount' => $record['cashback_amount']
                    ];
                }


                /* return [
                     'result'  => 'fail',
                     'code'    => $code,
                     'message' => 'Sorry, found the given deal code invalid',
                     'deal'    => []
                 ];*/
            } catch (\Exception $e) {
                return array("result" => 'fail', 'code' => $code, 'message' => $e->getMessage());
            }
        }elseif($this->getRequest()->isPost()){
            try{
                    $data = json_decode($this->getRequest()->getContent(), true);
                    $code = $data['deal_code'];
                    $global_merchant_id = $data['global_merchant_id'];
                    $redeemedObj = new MerchantRedeemedCode($this->getServiceLocator());
                    $record = $redeemedObj->getDetailsByRedeemedCodeAndGlobalMerchantId( $code, $global_merchant_id);

                    // $redeemedObj->scanRedeemedCode($code);
                    if( count($record) < 1)
                        throw new \Exception("Invalid code. Please try another code");

                    $deal_type = $record['deal_id'] ? 'deal' : 'cashback';
                    if ($deal_type == 'deal') {
                        $deal = $this->getDeal($record['deal_id']);
                        $deal['discount'] = round(($deal['discount'] * $deal['retail_price']) / 100, 2);
                        return [
                            'result' => 'success',
                            'type' => 'deal',
                            'code' => $code,
                            'message' => 'Deal code is successfully verified',
                            'deal' => $deal
                        ];
                    } else {
                        return [
                            'result' => 'success',
                            'type' => 'cashback',
                            'code' => $code,
                            'message' => 'Cashback code is successfully verified',
                            'cashback_amount' => $record['cashback_amount']
                        ];
                    }
                } catch (\Exception $e) {
                return array("result" => 'fail', 'code' => $code, 'message' => $e->getMessage());
            }
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
