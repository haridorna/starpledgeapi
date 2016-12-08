<?php
/**
 * Created by PhpStorm.
 * User: hari
 * Date: 4/17/14
 * Time: 4:18 PM
 */

namespace Common\Rest;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\AdapterAwareInterface;


class AbstractMapper extends AbstractTableGateway implements AdapterAwareInterface
{

    protected $adapter;
    protected $entity;
    protected $collection;

    public function __construct(Adapter $adapter, $entity)
    {
        $this->setDbAdapter($adapter);
        $this->entity = $entity;
    }

    public function setDbAdapter(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->initialize();
    }

    protected function obj2Array($data)
    {
        $dataArr = array();

        foreach ($data as $key => $item) {
            $dataArr[$key] = $item;
        }

        return $dataArr;
    }

    public function fetchAll()
    {
        $select = $this->getSql()->select();
        $paginatorAdapter = new DbSelect($select, $this->adapter);
        $collection = new AbstractCollection($paginatorAdapter);

        return $collection;
    }


    public function fetchOne($id)
    {
        $result = $this->select(array('id' => $id));
        $record = $result->current();

        return $record;
    }

    public function save($data, $id = FALSE)
    {
        if (!$id) {
            $data = is_object($data) ? $this->obj2Array($data) : $data;
            $this->insert($data);

            $id = $this->getLastInsertValue();
        } else {
            $this->update($this->obj2Array($data), array('id' => $id));
        }

        return $this->fetchOne($id);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id={$id}";
        $statement = $this->adapter->query($sql);
        $statement->execute(array());
    }

} 