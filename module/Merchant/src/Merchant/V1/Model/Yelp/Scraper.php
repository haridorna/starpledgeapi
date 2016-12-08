<?php
/**
 * Created by PhpStorm.
 * User: hari
 * Date: 4/18/14
 * Time: 6:03 PM
 */

namespace Merchant\V1\Model\Yelp;

use Common\Tools\HTMLParse;
use GuzzleHttp\Client;

class Scraper
{
    private $host = 'http://www.yelp.com';
    var $url;

    public function __construct()
    {
        ini_set('max_execution_time', 1800);
    }

    public function scrape($url = '')
    {
        $this->url = $url;
        if (!$url) {
            return json_encode(array());
        }

        $html = file_get_contents(urldecode($url));


       /* $client = new Client();
        $response = $client->get($url);

        if ($response->getStatusCode() != '200') {
            return FALSE;
        };*/
        //        echo $html; exit;

       /* $html = $response->getBody();

        if (trim($html) == '') {
            return FALSE;
        }*/

        //        echo $html; exit;

        $dom = new \DOMDocument();
        libxml_use_internal_errors(TRUE);
        $dom->loadHTML($html);
        libxml_clear_errors();
        $xpath = new \DOMXPath($dom);

        $working_hours = $this->getWorkingHours($xpath);

        // Currently I am limiting them for only five. We can get upto 99 images!
        //        $image_links = $this->getAllImages($xpath, 5);

        // Get images in the same page.
        $image_links = $this->getSamePageImages($xpath);

        // Additional information
        $additional_info = $result = $this->getAdditionalInfo($xpath);

        $merchant_url = $this->getMerchantUrl($xpath);

        $description = $this->getDescription($xpath, $dom);
        $dollarrange = $this->getDollarRange($xpath);

        return array(
            'merchant_url'    => $merchant_url,
            'description'     => $description,
            'working_hours'   => $working_hours,
            'additional_info' => $additional_info,
            'image_links'     => $image_links,
            'dollar_range'     => $dollarrange
        );
    }

    /**
     * Parses Yelp description.
     * Removes unncessaray icons, ratings etc.
     *
     * @param $xpath
     * @param $dom
     *
     * @return mixed|string
     */
    private function getDescription($xpath, $dom)
    {
        $description = $xpath->query('//div[@class="from-biz-owner-content"]');

        if (!$description->length) {
            return '';
        }

        $html = $dom->saveHTML($description->item(0));

        $html = preg_replace('~<h3>.*also recommends</h3>~', '', $html);
        $html = preg_replace('~<ul class="ylist">.*</ul>~s', '', $html);
        $html = preg_replace("~[\t\r\n]~", '', $html);

        return $html;
    }

    /**
     * Parses images available in the merchant page.
     *
     * @param $xpath
     *
     * @return array
     */
    private function getSamePageImages($xpath)
    {
        $tags = $xpath->query('//img[@class="photo-box-img"]');

        $image_links = array();
        foreach ($tags as $key => $tag) {
            $width = $tag->getAttribute('width');

            // Ignoring images with smaller width like icons etc.
            // Unfortunately yelp is providing same photo-box-img class for all images!
            if ($width >= 250) {
                $src = $tag->getAttribute('src');

                // Add http if it is missing in the link.
                if (substr($src, 0, 2) == '//') {
                    $src = 'http:' . $src;
                }
                $image_links [] = $src;
            }

        }

        return $image_links;
    }

    /**
     * Navigates to images page by fetching link of images page from merchant page.
     * Fetches all images links from images page.
     *
     * @param $xpath
     * @param $limit
     *
     * @return array
     */
    private function getAllImages($xpath, $limit)
    {
        $tags = $xpath->query('//*[@class="see-more show-all-overlay"]');
        $link = $tags->item(0);

        if (is_object($link) && $link->hasAttribute('href')) {
            $url = $this->host . $link->getAttribute('href');

            return $this->getImageLinks($url, $limit);
        }
    }

    /**
     * Parses working hours code from Yelp merchant page.
     *
     * @param $xpath
     *
     * @return array
     */
    private function getWorkingHours($xpath)
    {
        $tags = $xpath->query('//table[@class="table table-simple hours-table"]/tbody/tr');

        if (!$tags || $tags->length < 1) {
            return;
        }
        // var_dump($tags->text);exit;
        $working_hours = array();
        foreach ($tags as $key => $tag) {

            $day = $tag->getElementsByTagName('th');
            $working_hours[$key]['day'] = trim($day->item(0)->nodeValue);
            $hours = $tag->getElementsByTagName('td')->item(0);

            $count = $hours->getElementsByTagName('span')->length;

            $j=0;
            $time = "";
            for($i=0; $i<$count; $i++ ){
                $spanValue = $hours->getElementsByTagName('span')->item($i)->nodeValue . " ";
                if($j==2 && $i != 0){
                    $time .= " , ";
                }elseif($i != 0){
                    $time .= " - ";
                }
                $time .= $spanValue;
                $j++;
            }
            $working_hours[$key]['hours'] = $time;
           /* exit;
            var_dump($tag->getElementsByTagName('td')->getElementByTagName('span'));exit;
            $working_hours[$key]['hours'] = trim($hours->item(0)->nodeValue);
            var_dump($hours->item(0)->nextSibling );exit;*/
        }
        return $working_hours;
    }
    
    private function getDollarRange($xpath)
    {
        $tags = $xpath->query('//span[@class="business-attribute price-range"]');
        if (!$tags || $tags->length < 1) {
            return null;
        }
        $i = 0;
        foreach ($tags as $key => $tag)
        {
            if(isset($tag->textContent) && trim($tag->textContent) != "")
            {
                return $tag->textContent;
            }
        }
        return null;
    }

    /**
     * Deprecated - need rework since yelp has changed its dom
     *
     * @param $xpath
     *
     * @return array
     */
    private function getComments($xpath)
    {
        $comment_tags = $xpath->query('//*[starts-with(@id, "review_")]/div/div[2]/p');
        $name_tags = $xpath->query('//*[starts-with(@id, "review_")]/div/div[1]/div/ul[2]/li/a');
        $city_tags = $xpath->query('//*[starts-with(@id, "review_")]/div/div[1]/p');
        $date_tags = $xpath->query('//*[starts-with(@id, "review_")]/div/div[2]/div[1]/span');
        $img_tags = $xpath->query('//*[starts-with(@id, "review_")]/div/div[1]/div/div/a/img');
        $star_tags = $xpath->query('//*[starts-with(@id, "review_")]/div/div[2]/div[1]/div/div/i/img');

        $comments = $this->parseTags($comment_tags);
        $names = $this->parseTags($name_tags);
        $cities = $this->parseTags($city_tags);
        $dates = $this->parseTags($date_tags);
        $images = $this->parseTags($img_tags, 'src');
        $stars = $this->parseTags($star_tags, 'alt');

        $ret = array();
        foreach ($comments as $key => $comment) {
            $ret[$key]['comment'] = $comment;
            $ret[$key]['name'] = $names[$key];
            $ret[$key]['date'] = $dates[$key];
            $ret[$key]['city'] = $cities[$key];
            $ret[$key]['image'] = $images[$key];
            $ret[$key]['stars'] = $stars[$key];
        }

        return $ret;
    }

    /**
     * @param $nodeList
     * @param bool $attribute
     *
     * @return array
     */
    private function parseTags($nodeList, $attribute = FALSE)
    {
        if (!$nodeList) {
            return array();
        }

        $arr = array();
        foreach ($nodeList as $node) {
            if ($attribute != FALSE) {
                $arr[] = $node->getAttribute($attribute);
            } else {
                $arr[] = trim($node->nodeValue);
            }
        }

        return $arr;
    }

    /**
     * Parses additional info from Yelp merchant page.
     *
     * @param $xpath
     *
     * @return array
     */
    private function getAdditionalInfo($xpath)
    {
        $tags = $xpath->query('//*[@class="short-def-list"]/dl');

        if (!$tags || $tags->length < 1) {
            return;
        }

        $additional_info = array();
        foreach ($tags as $key => $tag) {
            $day = $tag->getElementsByTagName('dt');
            $additional_info[$key]['parameter'] = trim($day->item(0)->nodeValue);
            $hours = $tag->getElementsByTagName('dd');
            $additional_info[$key]['value'] = trim($hours->item(0)->nodeValue);
        }

        return $additional_info;
    }

    private function getImageLinks($url, $limit)
    {
        $html = file_get_contents($url);
        $dom = new \DOMDocument();
        libxml_use_internal_errors(TRUE);
        $dom->loadHTML($html);
        libxml_clear_errors();
        $xpath = new \DOMXPath($dom);

        $images = $xpath->query('//*[@id="photo-thumbnails"]/div/div[1]/div/a/img');

        $img_links = array();
        foreach ($images as $key => $image) {
            if ($key > $limit) {
                break;
            }
            $img_src = $image->getAttribute('src');

            if (substr($img_src, -7) == '/ms.jpg') {
                $img_src = str_replace('/ms.jpg', '/l.jpg', $img_src);
                if ($this->linkExists($img_src)) {
                    $img_links[] = $img_src;
                }
            }
        }

        return $img_links;
    }

    private function linkExists($url)
    {
        $headers = @get_headers($url);

        if (strpos($headers[0], '200') === FALSE) {
            return FALSE;
        }

        return TRUE;
    }

    public function getMerchantUrl($xpath)
    {
        $tags = $xpath->query('//*[@class="biz-website"]/a');
        $link = $tags->item(0);

        $url = FALSE;
        if (is_object($link) && $link->hasAttribute('href')) {
            $url = $link->getAttribute('href');
            $url = explode('url=', urldecode($url));
            $url = $url[1];

            if (trim($url)) {
                $url = explode('&', $url);
                $url = $url[0];
            }
        }

        return $url;
    }

    public function scrapeAllMerchants($yelp_ids){
            $url = "http://yelp.com/biz/".$yelp_ids;
            return $this->scrape($url);
    }
}
