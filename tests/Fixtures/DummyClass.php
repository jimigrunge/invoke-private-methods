<?php

namespace Jimigrunge\InvokePrivateMethods\Tests\Fixtures;


class DummyClass
{
    public function __construct()
    {

    }

    /**
     * @return string
     */
    private function myPrivateFunction($name = '')
    {
        return 'Test Success ' . $name;
    }
}
