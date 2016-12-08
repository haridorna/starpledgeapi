<?php
namespace Visitor\V1\Rpc\SearchByVisitor;

class SearchByVisitorControllerFactory
{
    public function __invoke($controllers)
    {
        return new SearchByVisitorController();
    }
}
