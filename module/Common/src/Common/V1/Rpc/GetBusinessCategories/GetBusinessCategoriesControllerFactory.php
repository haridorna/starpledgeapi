<?php
namespace Common\V1\Rpc\GetBusinessCategories;

class GetBusinessCategoriesControllerFactory
{
    public function __invoke($controllers)
    {
        return new GetBusinessCategoriesController();
    }
}
