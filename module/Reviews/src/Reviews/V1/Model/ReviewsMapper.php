<?php
/**
 * Project: PrivyPASS.com
 * Author: Hari Dornala
 * Date: 11/7/14
 * Time: 1:13 PM
 */

namespace Reviews\V1\Model;

use Zend\Db\TableGateway\TableGateway;

/**
 * Class ReviewsMapper
 *
 * @package Reviews\V1\Model
 */
class ReviewsMapper
{
    private $tblReviews;

    /**
     * @param TableGateway $tblReviews
     */
    public function __construct(TableGateway $tblReviews)
    {
        $this->tblReviews = $tblReviews;
    }

    /**
     * Function: saveData
     *
     * @author   Hari Dornala
     *
     *
     * @param $data
     *
     * @return mixed
     */
    public function saveData($data)
    {
        $adapter = $this->tblReviews->getAdapter();


        // Utility function
        $q = function ($name) use ($adapter) {
            return $adapter->platform->quoteValue($name);
        };

        $sql = "INSERT IGNORE INTO `global_merchant_reviews` (`review_id`, `global_merchant_id`, `yelp_id`, `source`, `reviewer_name`, `reviewer_image`, `reviewer_url`, `content`, `rating`, `review_date`, `rating_img_url`) VALUES ";

        $records = [];
        foreach ($data as $item) {

            $reviewId = md5(@$item['yelp_id'] . @$item['reviewer_name'] . @$item['reviewer_image'] . @$item['reviewer_url'] . @$item['source']. @$item['review_date'] . @$item['rating'] );

            $records[] .= "(" . $q($reviewId) . "," . $item['global_merchant_id'] ."," . $q($item['yelp_id']) . "," . $q($item['source']) . "," . $q($item['reviewer_name']) . "," . $q($item['reviewer_image']) . "," .$q($item['reviewer_url']) . "," . $q($item['content']) . "," . $q($item['rating']) . "," . $q($item['review_date']) . ",".$q($item['rating_img_url']).")";
        }

        $sql       = $sql . implode(',', $records);

        $statement = $adapter->createStatement($sql, array());

        return $statement->execute();
    }
}
