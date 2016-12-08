<?php
/**
 * Project: PrivyPASS.com
 * Author: Hari Dornala
 * Date: 7/23/14
 * Time: 1:46 PM
 */

namespace Facebook\V1\Model;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Merchant\V1\Model\Yelp\Yelp;

/**
 * Class FacebooYelpMap
 *
 * @package Facebook\V1\Model
 */
class FacebooYelpMap extends FacebookFeed
{
    protected $firms = array();
    protected $businessMap = array();

    public function __construct($serviceLocator, $customerId)
    {
        parent::__construct($serviceLocator, $customerId);
    }

    public function mapData()
    {
        $this->retrieveFacebookBusinessProfiles();
        $this->fetchYelpBusinessProfile();

        return $this->buildHtml($this->businessMap);
    }

    private function buildHtml($data)
    {
        $html = '<table border="1" width="100%" style="border-collapse:collapse">';
        $html .= '<tr><th></th><th>Facebook</th><th>Yelp</th></tr>';
        $i = 1;
        foreach ($data as $item) {
            $fb = $this->getFbHtml($item['fbfirm']);

            $yelpData                    = @$item['yelpfirm']['businesses'][0];
            $yelpData['SearchCriteria'] = $item['yelpfirm']['SearchCriteria'];
            $yelp                        = $this->getYelpHtml($yelpData);

            //            $yelpData = @$item['yelpfirm']['businesses'][1];
            //            $yelp .= $this->getYelpHtml($yelpData);

            $html .= "
                <tr>
                    <td style='vertical-align: top; width: 6%'>$i</td>
                    <th style='vertical-align: top; width: 47%'>$fb</th><td>$yelp</td>
                </tr>
            ";
            $i++;
        }

        $html .= '</table>';

        return $html;
    }

    private function getFbHtml($data)
    {
        $arr             = [];
        $arr['name']     = @$data['name'];
        $arr['link']     = @$data['link'];
        $arr['category'] = @$data['category'];
        $arr['phone']    = @$data['phone'];
        $arr['website']  = @$data['website'];
        $arr['location'] = @$data['location'];

        return $this->getTableFromArray($arr);;
    }

    private function getYelpHtml($data)
    {
        if (empty($data)) {
            return '';
        }

        $arr = [];

        $arr['name']            = @$data['name'];
        $arr['id']              = @$data['id'];
        $arr['Search Criteria'] = @$data['SearchCriteria'];
        $arr['is_claimed']      = @$data['is_claimed'];
        $arr['rating']          = @$data['rating'];
        $arr['url']             = @$data['url'];
        $arr['categories']      = @$data['categories'];
        $arr['display_phone']   = @$data['display_phone'];
        $arr['location']        = @$data['location'];
        $arr['categories']      = @$data['categories'];

        //        return $this->getTableFromArray($arr);
        return $this->getTableFromArray($arr);
    }

    private function getTableFromArray($data)
    {
        $html = '<table border="1" width="100%" style="border-collapse:collapse">';
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $value = $this->getTableFromArray($value);
            }

            $html .= "<tr>";

            $colspan = '';
            if (!is_numeric($key)) {
                $html .= "<th style='vertical-align:top; text-align:left'>$key</th>";
                $colspan = ' colspan="2"';
            }

            $html .= "<td$colspan>$value</td>";
            $html .= '</tr>';
        }
        $html .= '</table>';

        return $html;
    }

    public function retrieveYelpBusinessProfiles()
    {
        $client = new Client();
    }

    public function retrieveFacebookBusinessProfiles()
    {

        if (!isset($this->accessToken)) {
            return;
        }

        $places       = $this->feedSummary->getPlaces();
        $fbBusinesses = array();
        $client       = new Client();
        $queryParams  = [
            'access_token' => $this->accessToken,
        ];

        foreach ($places as $key => $place) {

            $country = @$place['place']['location']['country'];

            // Let us minimise request by testing country
            if ($country != 'United States') {
                continue;
            }

            $placeId = @$place['place']['id'];
            $name    = @$place['place']['name'];
            $street  = @$place['place']['location']['street'];
            $city    = @$place['place']['location']['city'];
            $state   = @$place['place']['location']['state'];

            $zip       = @$place['place']['location']['zip'];
            $latitude  = @$place['place']['location']['latitude'];
            $longitude = @$place['place']['location']['longitude'];

            $url = $this->graphUrl . $placeId;

            $response = $client->get($url, [
                'query' => $queryParams
            ]);

            $firm = $response->json();

            $this->firms[$key]['fbfirm'] = $firm;
            $this->firms[$key]['fbfeed'] = $place;
        }
    }

    protected function fetchYelpBusinessProfile()
    {
        foreach ($this->firms as $item) {
            $firm = $item['fbfirm'];

            if (!in_array($firm['category'], array(
                'Restaurant/Cafe',
                'Bar',
                'Club',
                'Hotel'
            ))
            ) {
                continue;
            }

            if ('United States' != @$firm['location']['country']) {
                continue;
            }

            $name      = @$firm['name'];
            $city      = @$firm['location']['city'];
            $country   = @$firm['location']['country'];
            $latitude  = @$firm['location']['latitude'];
            $longitude = @$firm['location']['longitude'];
            $street    = @$firm['location']['street'];
            $zip       = @$firm['location']['zip'];

            $location = "$street, $city, $country, $zip";
            $cll      = "$latitude, $longitude";

            $searchCriteria = array(
                'term'     => $name,
                'location' => $location,
                'cll'      => $cll,
                'limit'    => 1
            );

            $response                   = Yelp::get($searchCriteria);
            $response['SearchCriteria'] = $searchCriteria;
            $item['yelpfirm']           = $response;
            $this->businessMap[]        = $item;
        }
    }

    public function yelpTest()
    {
        $response = Yelp::get(array(
            'term'     => 'Peppercorn Grille',
            'location' => '553 Pine Knot Ave, Big Bear Lake, 92315',
            'cll'      => '34.242424543254,-116.91138986775',
            'limit'    => 2
        ));

        echo '<pre>';
        print_r($response);
        exit;
    }

    public function insertRandomAccounts()
    {
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $sql = "INSERT INTO `has_social_media` (`media_id`, `social_media_id`, `num_post`,`num_friends`, `num_likes`, `num_share`, `num_comments`) VALUES ";

        for ($i = 0; $i<10000; $i++) {
            $a = mt_rand(0, 5000);
            $b = mt_rand(0, 5000);
            $c = mt_rand(0, 8000);
            $d = mt_rand(0, 1000);
            $e = mt_rand(0, 1000);

            $sql.= "(1, 'XXX', $a, $b, $c, $d, $e),";
        }

        $sql = rtrim($sql, ',');

        $statement = $adapter->query($sql);
        $statement->execute(array());

        return array('done');
    }
} 