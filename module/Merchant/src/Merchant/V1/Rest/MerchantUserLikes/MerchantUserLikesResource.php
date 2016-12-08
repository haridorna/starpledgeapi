<?php
namespace Merchant\V1\Rest\MerchantUserLikes;

use ZF\ApiProblem\ApiProblem;
use ZF\ContentNegotiation\JsonModel;
use ZF\Rest\AbstractResourceListener;


class MerchantUserLikesResource extends AbstractResourceListener
{
    private $gateway;

    public function __construct(\Zend\Db\TableGateway\TableGateway $gateway)
    {
        $this->gateway = $gateway;
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
        $result = $this->gateway->select([
            'customer_id'      => $data->customer_id,
            'merchant_user_id' => $data->merchant_user_id,
			'merchant_id' => $data->merchant_id
        ]);

        if ($result->count() > 0) {
            return [
                'result'  => 'success',
                'message' => 'Merchant Like already Exists',
                'like'    => $result->current()->getArrayCopy()
            ];
        }

		try {
			$result = $this->gateway->insert([
				'customer_id'      => $data->customer_id,
				'merchant_user_id' => $data->merchant_user_id,
				'merchant_id' => $data->merchant_id
			]);
		} catch(\Exception $e) {
			return new ApiProblem(405, 'Sorry, Unable to add like, please check your data');
		}


        if ($result) {
            $result = $this->gateway->select(['id'=>$this->gateway->lastInsertValue]);

            return [
                'result'  => 'success',
                'message' => 'Merchant Like successfully inserted',
                'like'    => $result->current()->getArrayCopy()
            ];
        }

        return new ApiProblem(405, 'Sorry, Unable to create record');
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
        \Common\Tools\Logger::log("Merchant Delete Like Data: " .$id."\n" );
        return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     *
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        // \Common\Tools\Logger::log("Merchant Delete list Like Data: " .$data."\n" );
        $customerId     = $this->getEvent()->getRouteMatch()->getParam('customer_id');
        $merchantId     = $this->getEvent()->getRouteMatch()->getParam('merchant_id');
        $merchantUserId = $this->getEvent()->getRouteMatch()->getParam('merchant_user_id');

        $result = $this->gateway->select([
            'customer_id'      => $customerId,
            'merchant_id'      => $merchantId,
            'merchant_user_id' => $merchantUserId
        ]);

        if ($result->count() == 0) {
            return new ApiProblem(400, 'Merchant Like does not exist');
        }

        $result = $this->gateway->delete([
            'customer_id'      => $customerId,
			'merchant_id'      => $merchantId,
            'merchant_user_id' => $merchantUserId
        ]);

        if ($result) {
            return new ApiProblem(200, 'Merchant Like Successfully deleted', NULL, 'Merchant Like Deleted');
        }

        return new ApiProblem(405, 'Unable to Delete Like');
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
        return new ApiProblem(405, 'The GET method has not been defined for individual resources');
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
        $customerId     = $this->getEvent()->getRouteMatch()->getParam('customer_id');
		$merchantId     = $this->getEvent()->getRouteMatch()->getParam('merchant_id');
        $merchantUserId = $this->getEvent()->getRouteMatch()->getParam('merchant_user_id');

        $result = $this->gateway->select([
            'customer_id'      => $customerId,
			'merchant_id'      => $merchantId,
            'merchant_user_id' => $merchantUserId
        ]);
        \Common\Tools\Logger::log("Merchant Like Fetch  Data merchant_id, merchant_id , merchant_user_id: " .$customerId. ','.$merchantId.','.$merchantUserId."\n" );
        if ($result->count() > 0) {
            $result = [
                'result'  => 'success',
                'message' => 'Merchant Like Exists',
                'like'    => $result->current()->getArrayCopy()
            ];
            return new ApiProblem(200, '', null, '', $result );
        } else {
            return new ApiProblem(200, 'Merchant User Like does not exist', null, 'No Record');
        }
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     *
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     *
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
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
        return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
    }
}
