<?php
namespace Merchant\V1\Rpc\AdditionalInfoTest;

use Herrera\Json\Exception\Exception;
use Merchant\V1\Model\Yelp\Scraper;
use Zend\Mvc\Controller\AbstractActionController;

class AdditionalInfoTestController extends AbstractActionController
{
    public function additionalInfoTestAction()
    {
        // making scraper object
        $scraper = new Scraper();

        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $sql       = "SELECT yelp_id FROM `global_merchant` WHERE additional_info is null and working_hours is null ORDER BY id DESC LIMIT 20";
        $statement = $adapter->createStatement($sql, []);
        $result    = $statement->execute();
        $response = array();

        if($result->count() >0){
            foreach($result as $item){
                $url = "http://www.yelp.com/biz/".$item['yelp_id'];
                try{
                    $scrapperResult = $scraper->scrape($url);
                    $additiona_info = json_encode($scrapperResult['additional_info']);
                    $dollar_range = $scrapperResult['dollar_range'];
                    $working_hours = json_encode($scrapperResult['working_hours']);

                    $sql = "UPDATE global_merchant SET additional_info='".$additiona_info."' , working_hours='".$working_hours."', dollar_range='".$dollar_range."' where yelp_id='".$item['yelp_id']."'";
                    $statement = $adapter->createStatement($sql, []);
                    $result    = $statement->execute();

                    $response[]['additional_info'] = $additiona_info;
                    $response[]['yelp_id'] = $item['yelp_id'];
                    $response[]['dollar_range'] = $dollar_range;
                    $response[]['working_hours'] = $working_hours;
                    usleep(50000);
                }catch(Exception $e){
                    echo $e->getMessage();
                }
                echo $item['yelp_id'];
                echo "\n\n";
            }
        }else{
            echo "No Records Found";
        }

        return [
            'count' => $result->count(),
            'banks' => $response
        ];
    }
}
