<?php

namespace Merchant\V1\Rpc\MerchantYelpLookup;

use Customer\V1\Model\Merchant;
use Zend\Mvc\Controller\AbstractActionController;
use Merchant\V1\Model\Yelp\Yelp;

class MerchantYelpLookupController extends AbstractActionController {

    public function merchantYelpLookupAction() {

        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = $request->getContent();
            $data = json_decode($data);

            $serviceLocator = $this->getServiceLocator();
            $yelp = new Yelp($serviceLocator);

            $yelpData = $yelp->getYelpData($data->business_name, $data->business_address);
            if (isset($data->limited_data) && $data->limited_data == "Yes") {
                $limited_data = array();
                foreach ($yelpData["businesses"] as $y) {
                    $limited_data[] = array("id" => $y["id"], "name" => $y["name"], "address" => $y["display_address1"] . ", " . $y["display_address2"]);
                }
                return array("merchants" => $limited_data);
            } else {
                $yelpData = $this->updatePrivyPassStarRatting($yelpData);
                return $yelpData;
            }
        }
    }

    public function merchantAjaxYelpLookupAction() {

        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = $request->getContent();
            $data = json_decode($data);

            $serviceLocator = $this->getServiceLocator();
            $yelp = new Yelp($serviceLocator);

            $yelpData = $yelp->getYelpData($data->business_name, $data->business_address);
            if (isset($data->limited_data) && $data->limited_data == "Yes") {
                $limited_data = array();
                foreach ($yelpData["businesses"] as $y) {
                    $limited_data[] = array("id" => $y["id"], "name" => $y["name"], "address" => $y["display_address1"] . ", " . $y["display_address2"]);
                }
                return array("merchants" => $limited_data);
            } else {
                return $yelpData;
            }
        }


    }

    public function updatePrivyPassStarRatting($yelpData){
        $merchantObj = new Merchant($this->getServiceLocator());
        if(isset($yelpData['businesses'])){
            foreach($yelpData['businesses'] as $key=>$value){
                if($value['rating']){
                    $yelpData['businesses'][$key]['rating_img_url_small'] = 'https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-'.$merchantObj->roundValueOfReviews($value['rating']).'-stars.png';
                    $yelpData['businesses'][$key]['rating_img_url'] = 'https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-'.$merchantObj->roundValueOfReviews($value['rating']).'-stars@2x.png';
                    $yelpData['businesses'][$key]['rating_img_url_large'] = 'https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-'.$merchantObj->roundValueOfReviews($value['rating']).'-stars@3x.png';
                }
            }
        }
        return $yelpData;
    }
}
