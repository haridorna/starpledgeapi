<?php
/**
 * Project: PrivyPASS.com
 * Author: Hari Dornala
 * Date: 11/7/14
 * Time: 12:29 PM
 */

namespace Reviews\V1\Model\Scraper;

use Reviews\V1\Model\ReviewsMapper;

/**
 * Class TripAdvisor
 *
 * @package Reviews\V1\Model\Scraper
 */
class TripAdvisor
{
    private $url;
    private $numReviews = 0;
    private $maxPages  = 1;

    public function scrape($url)
    {
        if (!$url) {
            return array();
        }

        $this->url = $url;

        do {
            $data = $this->scrapePage($this->numReviews);
            $this->reviewsMapper->saveData($data, $yelpId, 'yelp');
            $i++;
        } while ($i < $this->maxPages);
    }

    public function scrapePage($start = 0)
    {
        if ($start) {
            $url = $this->url . '?start=' . trim($start);
        } else {
            $url = $this->url;
        }

        $html = file_get_contents(urldecode($url));
        $dom  = new \DOMDocument();

        libxml_use_internal_errors(TRUE);
        $dom->loadHTML($html);
        libxml_clear_errors();

        $xml = simplexml_import_dom($dom);

        $names     = $xml->xpath("//div[@class='username mo']/span");
        $comments  = $xml->xpath("//div[@class='entry']/p[@class='partial_entry']");
        $locations = $xml->xpath("//div[@class='member_info']/div[@class='location']");
        $ratings   = $xml->xpath("//div[contains(@class, 'rating reviewItemInline')]/span[contains(@class, 'rate sprite-rating_s rating_s')]/img/@alt");
        $dates     = $xml->xpath("//span[@class='ratingDate']");
        $thumbs    = $xml->xpath("//div[@class='member_info']/div/div[contains(@class,'avatar profile')]/a/img/@src");

        print_r(
            $names    ,
            $comments ,
            $locations,
            $ratings  ,
            $dates    ,
            $thumbs
        ); exit;



        if (!$this->maxPages) {
            $pageIndicator  = $xml->xpath("//div[@class='page-of-pages']");
            $pageIndicator  = explode('of', $pageIndicator[0]->__toString());
            $pageIndicator  = trim($pageIndicator[1]);
            $this->maxPages = $pageIndicator;
        }

        $merchantRating = array_shift($ratings);
        $count          = count($comments);
        $this->numReviews += $count;

        $data = [];
        for ($i = 0; $i < $count; $i++) {
            $date   = date('Y-m-d', strtotime($dates[$i]->__toString()));
            $name   = $names[$i]->__toString();
            $name   = str_replace('.', '', $name);
            $imgUrl = $thumbs[$i]->__toString();
            if (strpos($imgUrl, '//') === 0) {
                $imgUrl = 'http:' . $imgUrl;
            }

            // For unique id, digest formed using...
            // REVIEWER_NAME, SOURCE_SITE, YELP_ID, DATE_OF_REVIEW, REVIEWER_IMAGE_URL
            $id = $name . 'yelp' . $this->yelpId . $imgUrl . $date;
            $id = md5($id);

            $data[$i]['id']       = $id;
            $data[$i]['name']     = $name;
            $data[$i]['comment']  = $comments[$i]->__toString();
            $data[$i]['location'] = $locations[$i]->__toString();
            $data[$i]['rating']   = $ratings[$i]->__toString();
            $data[$i]['image']    = $imgUrl;
            $data[$i]['date']     = $date;
        }

        return $data;
    }
} 