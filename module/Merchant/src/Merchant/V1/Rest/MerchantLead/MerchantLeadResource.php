<?php
namespace Merchant\V1\Rest\MerchantLead;

use Common\Rest\AbstractResource;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

class MerchantLeadResource extends AbstractResource
{

    protected $mapper;
    protected $serviceLocator;

    public function __construct($merchantMapper, $sm)
    {
        parent::__construct($merchantMapper);
        $this->mapper = $merchantMapper;
        $this->serviceLocator = $sm;
    }

    public function delete($id)
    {
       return new ApiProblemResponse(new ApiProblem(404, 'Not Implemented'));
    }

    public function fetch($id)
    {
        return new ApiProblemResponse(new ApiProblem(404, 'Not Implemented'));
    }

    public function fetchAll($params = array())
    {
        return new ApiProblemResponse(new ApiProblem(404, 'Not Implemented'));
    }

    public function update($id, $data)
    {
        return new ApiProblemResponse(new ApiProblem(404, 'Not Implemented'));
    }

   /* public function update($id, $data)
    {
        exit;
        $data = (object) $this->getInputFilter()->getValues();
        try{
            // $result = $this->mapper->save($data, $id);
            $this->mapper->sendEmailAlertToAdmin($data, $this->serviceLocator);
            exit;
            return $result;
        }catch(\Exception $e){

        }

    }*/

    public function create($data)
    {
        $data = (object) $this->getInputFilter()->getValues();

        try{
            $result = $this->mapper->save($data);
            $this->mapper->sendEmailAlertToAdmin($data, $this->serviceLocator);
            return $result;
        }catch(\Exception $e){
            return new ApiProblemResponse(new ApiProblem(422, $e->getMessage()));
        }

    }

}
