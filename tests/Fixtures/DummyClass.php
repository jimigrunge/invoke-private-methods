<?php

namespace Jimigrunge\InvokePrivateMethods\Tests\Fixtures;


class DummyClass
{
    public function __construct()
    {
    }

    /**
     * Dummy method
     *
     * @return string
     */
    public function callPrivateFunction()
    {
        return $this->myPrivateFunction();
    }

    /**
     * Method you should not be albe to call or test
     *
     * @return string
     */
    private function myPrivateFunction($name = '')
    {
        return 'Test Success ' . $name;
    }
}
