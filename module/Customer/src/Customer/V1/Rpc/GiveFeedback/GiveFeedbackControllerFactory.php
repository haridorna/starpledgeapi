<?php
namespace Customer\V1\Rpc\GiveFeedback;

class GiveFeedbackControllerFactory
{
    public function __invoke($controllers)
    {
        return new GiveFeedbackController();
    }
}
