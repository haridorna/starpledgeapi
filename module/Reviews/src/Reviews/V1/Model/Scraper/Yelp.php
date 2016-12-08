<?php
/**Reviews\V1\Model\Scraper
 * Project: PrivyPASS.com
 * Author: Hari Dornala
 * Date: 11/7/14
 * Time: 12:30 PM
 */

namespace Reviews\V1\Model\Scraper;

/**
 * Class Yelp
 * Performs scrapping of Yelp Reviews.
 *
 * @package Reviews\V1\Model\Scraper
 * @author  Hari
 * @date    7th Sep 2014
 */
class Yelp
{
    private $yelpId;
    private $url;
    private $maxPages = 0;
    private $numReviews = 0;

    /**
     * Function: scrape
     * This function scrapes yelp biz page and returns available reviews.
     * This may break if any change occurs in yelp page dom.
     *
     * @author   Hari Dornala
     *
     * @param $yelpId
     *
     * @return array|string
     */
    public function scrape($yelpId)
    {
        if (!$yelpId) {
            return array();
        }

        $this->yelpId = $yelpId;
        $this->url    = 'http://www.yelp.com/biz/' . $yelpId;
        $i            = 0;

        $data = [];
        do {
            $page   = $this->scrapePage($this->numReviews);
            $data[] = $page;
            $i++;
        } while ($i < $this->maxPages);

        return $data;
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

        $names     = $xml->xpath('//*[contains(@class, "user-passport-info")]/li/a');
        $comments  = $xml->xpath('//*[contains(@class, "review_comment")]');
        $locations = $xml->xpath('//*[contains(@class, "user-location")]/b');
        $ratings   = $xml->xpath('//*[contains(@class, "rating-very-large")]/meta/@content');
        $dates     = $xml->xpath('//*[contains(@class, "rating-very-large")]/span/meta/@content');
        $thumbs    = $xml->xpath("//div[@class='ypassport media-block clearfix']/div[@class='media-avatar']/div[@class='photo-box pb-60s']/a/img[@class='photo-box-img']/@src");

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
