<?php
namespace Customer\V1\Rpc\GetSurveyAnss;

class GetSurveyAnssControllerFactory
{
    public function __invoke($controllers)
    {
        return new GetSurveyAnssController();
    }
}
