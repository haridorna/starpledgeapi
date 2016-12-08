<?php
namespace Merchant\V1\Rest\Merchant;

use Common\Rest\AbstractResource;
use Common\Tools\Password;

class MerchantResource extends AbstractResource
{
    protected $mapper;
    protected $businessCategoryMapper;

    public function __construct($merchantMapper, $businessCategoryMapper)
    {
        parent::__construct($merchantMapper);
        $this->businessCategoryMapper = $businessCategoryMapper;
    }

    /**
     * Create a resource
     *
     * @param  mixed $data
     *
     * @return ApiProblem|mixed
     */
    public function create($data, $id = FALSE)
    {
        $data = (object) $this->getInputFilter()->getValues();

//        if (isset($data->password)) {
//            $data->salt = Password::createSalt();
//            $data->password = Password::createPassword($data->salt, $data->password);
//        }

        if (isset($data->business_categories)) {
            $business_categories = $data->business_categories;
            unset($data->business_categories);
        }

        $merchant = $this->mapper->save($data, $id);

        if (isset($business_categories)) {
            foreach ($business_categories as $category_id) {
                $category_id = (int) $category_id;
                if ($category_id > 0) {
                    $this->mapper->addBusinessCategory($merchant->id, $category_id);
                }
            }
        }

        return $merchant;
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
        $this->mapper->deleteAllBusinessCategories($id);
        return $this->create($data, $id);
    }
}
