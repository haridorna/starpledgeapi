<?php
/**
 * Project: PrivyPASS.com
 * Author: Hari Dornala
 * Date: 1/22/15
 * Time: 1:00 PM
 */

namespace Admin\Model;


class Merchants
{
    const ITEMS_PER_PAGE = 15;
    private $serviceLocator;

    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function getMerchantList($page = 1)
    {
        if ($page > 0) {
            $page--;
        }

        $offset  = self::ITEMS_PER_PAGE * $page;
        $limit   = self::ITEMS_PER_PAGE;
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $sql = "SELECT * FROM `merchant` LIMIT ?, ?";

        $statement = $adapter->createStatement($sql, [$offset, $limit]);
        $result    = $statement->execute();

        $merchants = [];
        if ($result->count() > 0) {
            foreach ($result as $item) {
                $merchants[] = $item;
            }
        }

        return $merchants;
    }

    public function getPaginator($page = 1)
    {
        if ($page < 1) {
            $page = 1;
        }

        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');

        $sql = "SELECT * FROM `merchant`";

        $statement = $adapter->createStatement($sql, []);
        $result    = $statement->execute();

        $count      = $result->count();
        $last = ceil($count / self::ITEMS_PER_PAGE);
        //$last = $totalPages - 1;

        $html = '<div class="btn-group" role="group">';

        $disabled = ($page == 1) ? 'disabled' : '';
        $html .= '<button type="button" class="btn btn-default ' . $disabled . '"><a href="/admin/merchants/1">First</a></button>';

        $disabled = ($page == 1) ? 'disabled' : '';
        $html .= '<button type="button" class="btn btn-default ' . $disabled . '"><a href="/admin/merchants/' . ($page - 1) . '">Previous</a></button>';

        $disabled = ($page == $last) ? 'disabled' : '';
        $html .= '<button type="button" class="btn btn-default ' . $disabled . '"><a href="/admin/merchants/' . ($page + 1) . '">Next</a></button>';

        $disabled = ($page == $last) ? 'disabled' : '';
        $html .= '<button type="button" class="btn btn-default ' . $disabled . '"><a href="/admin/merchants/' . $last . '">Last</a></button>';

        $html .= '<div>';

        return $html;
    }
} 