<?php
namespace Customer\V1\Rest\Customer;

use Common\Rest\AbstractResource;
use Common\Tools\Logger;
use Common\Tools\Password;
use Common\Tools\Util;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use Application\Auth\User;

class CustomerResource extends AbstractResource
{
    protected $cityMapper;

    /**
     * Constructor
     *
     * @param $mapper
     * @param $cityMapper
     */
    public function __construct($mapper, $cityMapper)
    {
        $this->mapper = $mapper;
        $this->cityMapper = $cityMapper;
    }

    /**
     * Create is overriden to add certain additional functionaity like
     *  - create and add password, salt
     *  - Add hardcoded city and stage names to the record.
     * @author Hari
     * @date 28 May 2014
     *
     * @param mixed $data
     * @param bool $id
     *
     * @return mixed|\ZF\ApiProblem\ApiProblem
     */
    public function create($data, $id = FALSE)
    {
        $data = (object) $this->getInputFilter()->getValues();
        // add extra columns city state password and salt
        $data = $this->addColumns($data);

        $customer = $this->mapper->save($data, $id);

        return $customer;
    }

    /**
     * @param mixed $id
     * @param mixed $data
     *
     * @return mixed|\ZF\ApiProblem\ApiProblem
     */
    public function update($id, $data)
    {
        if (empty($data)) {
            return new ApiProblemResponse(new ApiProblem(422, 'Data can not be empty'));
        }
        
        // user validation
        $user = User::getInfo();
        // Logger::log("email update: ".json_encode($data));
        // var_dump($user);
        if (!$user) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }

        if ($user['customer_id'] != $id) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }
        
        $data = $this->getInputFilter()->getValues();

        foreach ($data as $key=>$value) {
            if (empty($data[$key])) {
                unset($data[$key]);
            }
        }

        if (count($data) == 0) {
            return new ApiProblemResponse(new ApiProblem(422, 'Data can not be empty'));
        }
  
        $data = (object) $data;
        if(property_exists($data, "city_id")){
            $data->city_id = trim($data->city_id);
        }

        $mapperDataCheck = $this->mapper->getUser($id);

        if ($this->mapper->emailExists($mapperDataCheck)) {
            if(property_exists( $data, "email")){
                unset($data->email);
            }
            // echo "email exist";
        }

        if ($this->mapper->passwordExists($mapperDataCheck)) {
            // Don't update password if it is not empty
            //echo "password exist";
            if(property_exists( $data, "password")){
                unset($data->password);
                return new ApiProblem('405', 'Password cannot be updated through this service');
            }
        }

        try{
            $data = $this->addColumns($data);
        }catch(\Exception $e){
            return new ApiProblemResponse( new ApiProblem(405, $e->getMessage()));
        }


        if(property_exists($data, "email")){
            $email = trim($data->email);

            $record = $this->mapper->fetchOne($id);
            $oldEmail = trim($record->email);

            if ($email) {
                if ($oldEmail) {
                    unset($data->email);
                }
            } else {
                if (!$oldEmail) {
                    return new ApiProblem('412', 'Customer Email is required');
                } else {
                    unset($data->email);
                }
            }
        }

        $data = $this->mapper->save($data, $id);

        $data['current_privypass_score'] = $this->mapper->getPrivpassScore($id);

        return $data;
    }

    /**
     * Adds City and State based on Id given.
     *
     * @param $data
     *
     * @return mixed
     */
    private function  addColumns($data)
    {
        date_default_timezone_set('UTC');
        if (!empty($data->password)) {
            if(strlen($data->password)<4){
                throw new \Exception("Password must be more then 4 characters.");
            }
            $data->salt = Password::createSalt();
            $data->password = Password::createPassword($data->salt, trim($data->password));
            $data->password_updated = date("Y-m-d H:i:s");
        }

        if (property_exists($data, "city_id") && !empty($data->city_id)) {
            $city = $this->getCityById($data->city_id);

            $data->city = $city->name;
            $data->state = $city->state_abbreviation;
        }

        return $data;
    }

    /**
     * Fetches City by Id given
     *
     * @author Hari
     * @date 28 May 2014
     */
    private function getCityById($id)
    {
        return $this->cityMapper->fetchOne($id);
    }

    /**
     * overriding the parent function
     * @author Rajesh
     * @date 27th Nov 2015
     * @param mixed $id
     * @return mixed
     */
    public function fetch($id){
        $data = $this->mapper->fetchOne($id);
        $data['password_updated'] = Util::timeElapsedString($data['password_updated']);
        return $data;
    }
}
