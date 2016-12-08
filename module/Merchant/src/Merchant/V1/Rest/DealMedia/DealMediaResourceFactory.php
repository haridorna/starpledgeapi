<?php
namespace Merchant\V1\Rest\DealMedia;

class DealMediaResourceFactory
{
    public function __invoke($services)
    {
        return new DealMediaResource();
    }
}
