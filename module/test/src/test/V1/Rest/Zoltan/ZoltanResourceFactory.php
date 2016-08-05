<?php
namespace test\V1\Rest\Zoltan;

class ZoltanResourceFactory
{
    public function __invoke($services)
    {
        return new ZoltanResource();
    }
}
