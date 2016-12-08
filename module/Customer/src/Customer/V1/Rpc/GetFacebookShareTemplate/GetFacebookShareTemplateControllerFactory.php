<?php
namespace Customer\V1\Rpc\GetFacebookShareTemplate;

class GetFacebookShareTemplateControllerFactory
{
    public function __invoke($controllers)
    {
        return new GetFacebookShareTemplateController();
    }
}
