<?php
namespace Merchant\V1\Rest\BusinessCategory;

class BusinessCategoryResourceFactory
{
    public function __invoke($services)
    {
        return new BusinessCategoryResource();
    }
}
