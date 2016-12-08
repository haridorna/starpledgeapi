<?php
/**
 * Project: PrivyPASS.com
 * Author: Hari Dornala
 * Date: 7/17/14
 * Time: 12:09 PM
 */

namespace Facebook\V1\Model;

use Common\Tools\Logger;

/**
 * Class FacebookFeedSummary
 *
 * @package Facebook\V1\Model
 */
class FacebookFeedSummary
{
    protected $feed = array();
    protected $posts = 0;
    protected $likes = 0;
    protected $comments = 0;
    protected $shares = 0;
    protected $places = array();

    /**
     * Function: addAggregates
     *
     * @author   Hari Dornala
     *
     * @param $data
     */
    public function process($data)
    {
        Logger::log("At beginning of FacebookFeedSummary::process(Count-".count($data).")\n") ;

        foreach ($data as $item) {
            $this->likes += count(@$item['likes']);
            $this->comments += count(@$item['comments']);
            $statusType = @$item['status_type'];
            $shares = @$item['shares']['count'];

            if ($statusType != 'approved_friend') {
                $this->posts += 1;
            }

            if (isset($shares)) {
                $this->shares += $shares;
            }

            $this->feed[] = $item;

            if (array_key_exists('place', $item)) {
                $this->places[] = array(
                    'id'           => @$item['id'],
                    'story'        => @$item['story'],
                    'message'      => @$item['message'],
                    'created_time' => @$item['created_time'],
                    'type'         => @$item['type'],
                    'status_type'  => @$item['status_type'],
                    'from'         => @$item['from'],
                    'to'           => @$item['to'],
                    'place'        => $item['place']
                );
            }
        }

        Logger::log("At end of FacebookFeedSummary::process()\n") ;
    }

    public function getSummary()
    {
        return array(
            'posts'    => $this->posts,
            'likes'    => $this->likes,
            'comments' => $this->comments,
            'shares'   => $this->shares
        );
    }

    public function getFeed()
    {
        return $this->feed;
    }

    public function getPlaces()
    {
        return $this->places;
    }
}