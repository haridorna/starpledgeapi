<?php
/**
 * Project: PrivyPASS.com
 * Author: Hari Dornala
 * Date: 2/11/15
 * Time: 3:26 PM
 */

namespace Admin\Model;

use GuzzleHttp\Client;
use Zend\Db\TableGateway\TableGateway;

class GrouponScraper
{
    private $serviceLocator;

    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function scrape($post)
    {
        $client   = new Client();
        $url      = $post['url'];
        $response = $client->get($url);
        if ($response->getStatusCode() == '200') {
            $html = $response->getBody();

            $dom = new \DOMDocument();
            libxml_use_internal_errors(TRUE);
            $dom->loadHTML($html);
            libxml_clear_errors();
            $xpath = new \DOMXPath($dom);
            $deal  = $this->getData($xpath, $dom);
            $deal['global_merchant_id'] = $post['global_merchant_id'];

            return $deal;
        }

        return NULL;
    }

    private function getData($xpath, $dom)
    {
        $deal = [];

        $list          = $xpath->query('//h1[@class="deal-page-title"]');
        $deal['title'] = $list->item(0)->textContent;
        $deal['title'] = trim(preg_replace('/\n/', '', $deal['title']));

        $list          = $xpath->query('//img[@class="featured-image"]');
        $deal['image'] = $list->item(0)->getAttribute('src');

        $list = $xpath->query('//td[@id="discount-value"]');

        $price    = NULL;
        $discount = NULL;

        if (is_object($list->item(0))) {
            $price = $list->item(0)->textContent;
            $price = str_replace('$', '', $price);
            $price = floatval($price);

            $list     = $xpath->query('//td[@id="discount-percent"]');
            $discount = floatval($list->item(0)->textContent);
        }

        if ($price == NULL) {
            $list = $xpath->query('//span[@class="price"]');
            $item = $list->item(0);

            if (is_object($item)) {
                $price = $item->textContent;
            }
        }

        if ($price == NULL) {
            $list        = $xpath->query('//span[@class="breakout-option-price"]');
            $item        = $list->item(0);
            $optionPrice = 0;
            if (is_object($item)) {
                $optionPrice = str_replace('$', '', $item->textContent);
                $optionPrice = floatval($optionPrice);
            }

            if ($optionPrice > 0) {
                $list        = $xpath->query('//span[@class="breakout-option-value"]');
                $optionValue = str_replace('$', '', $list->item(0)->textContent);
                $optionValue = floatval($optionValue);

                $price    = round($optionValue, 2);
                $discount = (($optionValue - $optionPrice) * 100) / $optionValue;
                $discount = round($discount, 0);
            }

        }


        $deal['retail_price'] = $price;
        $deal['discount']     = $discount;

        $list           = $xpath->query('//div[@itemprop="description"]');
        $deal['detail'] = $dom->saveHTML($list->item(0));

//        $list = $xpath->query('//div[@class="address"]');
//
//        $address = [];
//        foreach ($list->item(0)->childNodes as $item) {
//            $content = trim($item->textContent);
//
//            if ($content != '' && $content != 'Get Directions') {
//                $address[] = $content;
//            }
//
//        }
//
//        $deal['address'] = $address;

        $list = $xpath->query('//ul[@class="tags"]/li/a');
        foreach ($list as $item) {
            $deal['tags'][] = $item->textContent;
        }
//        $list = $xpath->query('//div[@class="merchant-profile"]');
//        $deal['merchant-profile'] = $dom->saveHTML($list->item(0));

        return $deal;
    }

    public function saveDeal($post)
    {
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $tbl     = new TableGateway('merchant_deal', $adapter);
        $couponCode = $this->getCouponCode();

        $tbl->insert([
            'global_merchant_id' => $post['save_global_merchant_id'],
            'title'              => $post['title'],
            'detail'             => $post['detail'],
            'redeem_limit'       => 1,
            'retail_price'       => $post['retail_price'],
            'discount'           => $post['discount'],
            'coupon_code'        => $couponCode
        ]);

        $merchantDealId = $tbl->getLastInsertValue();

        if (strlen($post['image']) > 0) {
            $dealMedia = new TableGateway('deal_media', $adapter);
            $data      = [
                'merchant_deal_id' => $merchantDealId,
                'type'             => 'IMAGE',
                'resource_url'     => $post['image'],
                'date_uploaded'    => date('Y-m-d H:i:s')
            ];

            $dealMedia->insert($data);
        }

    }

    private function getCouponCode()
    {
        $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $code = '';



        for ($i = 0; $i<10; $i++) {
            $rand = rand(0, strlen($str)-1);
            $code .= $str[$rand];
        }

        return $code;
    }

    public function getMerchantList()
    {
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $sql = "SELECT id, `name`, yelp_id FROM global_merchant";

        $statement = $adapter->createStatement($sql, array());
        $result    = $statement->execute();
        $merchants = [];

        foreach ($result as $item) {
            $merchants[] = $item;
        }

        return $merchants;
    }

} 