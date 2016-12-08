<?php
namespace Merchant\V1\Rpc\ClaimBusiness;

class ClaimBusinessControllerFactory
{
    public function __invoke($controllers)
    {
        return new ClaimBusinessController();
    }
}
