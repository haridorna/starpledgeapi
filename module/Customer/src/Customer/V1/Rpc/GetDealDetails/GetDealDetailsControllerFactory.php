<?php
namespace Customer\V1\Rpc\GetDealDetails;

class GetDealDetailsControllerFactory
{
    public function __invoke($controllers)
    {
        return new GetDealDetailsController();
    }
}
