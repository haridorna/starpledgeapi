<?php
/**
 * Created by PhpStorm.
 * User: hari
 * Date: 4/17/14
 * Time: 3:07 PM
 */

namespace Common\Rest;

use ZF\Rest\AbstractResourceListener;
use ZF\ApiProblem\ApiProblem;

# use ZF\ApiProblem\ApiProblemResponse;

/**
 * Class AbstractResource
 *
 * @package Common\Rest
 * @author  Hari
 * @date
 */
abstract class AbstractResource extends AbstractResourceListener
{
    /**
     * Reference to DataMapper
     *
     * @var Object
     */
    protected $mapper;

    /**
     * Constuctor
     *
     * @param $mapper
     */
    public function __construct($mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * Create a resource
     *
     * @param  mixed $data
     *
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        $data = (object) $this->getInputFilter()->getValues();
        return $this->mapper->save($data);
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     *
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        $this->mapper->delete($id);

        return new ApiProblem(204);
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     *
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        return $this->mapper->fetchOne($id);
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     *
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = array())
    {
        //		if (array_key_exists('HTTP_X_REQUESTED_WITH', $_SERVER) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        //			return new ApiProblemResponse(new ApiProblem(404, 'Ajax call'));
        //        }

        return $this->mapper->fetchAll();
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     *
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        $data = (object) $this->getInputFilter()->getValues();
        return $this->mapper->save($data, $id);
    }
} 