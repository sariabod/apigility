<?php
namespace test\V1\Rest\Tester;

class TesterResourceFactory
{
    public function __invoke($services)
    {
        return new TesterResource();
    }
}
