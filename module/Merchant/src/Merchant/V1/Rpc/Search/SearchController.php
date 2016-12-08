<?php
namespace Merchant\V1\Rpc\Search;

use Zend\Mvc\Controller\AbstractActionController;
use Merchant\V1\Model\Yelp\YelpSearch;
use Merchant\V1\Model\Yelp\Yelp;

class SearchController extends AbstractActionController
{
    public function searchAction()
    {
        $request = $this->getRequest();
        if ($request->isPost()) {
            try{
                $data = $request->getContent();
                $data = json_decode($data, true);
                if(!isset($data['location']) && !isset($data['cll'])){
                    $data['location'] = 'Fremont';
                }
                $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
                $serviceLocator = $this->getServiceLocator();
                $yelpSearchObj = new YelpSearch($adapter, $serviceLocator);
                $yelpData = $yelpSearchObj->yelpSearch($data);
                $result = $data;
                //  $yelpDataMapped = $yelpSearchObj->yelpDataMapping($yelpData->business);
                if (isset($data->limited_data) && $data->limited_data == "Yes") {
                    $limited_data = array();
                    foreach ($yelpData["businesses"] as $y) {
                        $limited_data[] = array("id" => $y["id"], "name" => $y["name"], "address" => $y["display_address1"] . ", " . $y["display_address2"]);
                    }
                    return array("merchants" => $limited_data);
                } else {

                    return array_merge($result, $yelpData);
                }
               // $result = array("user_input"=>$data,$yelpData );

                return array_merge($result, $yelpData);


            }catch (Exception $e){
                return new \ZF\ApiProblem\ApiProblemResponse(
                    new \ZF\ApiProblem\ApiProblem(400, $e->getMessage())
                );
            }

        }
        return false;
    }
}
