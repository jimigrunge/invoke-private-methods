<?php

namespace Jimigrunge\InvokePrivateMethods\Tests;

use Jimigrunge\InvokePrivateMethods\Tests\Fixtures\DummyClass;

class InvokePrivateMethodTraitTest extends \PHPUnit_Framework_TestCase
{
    use \Jimigrunge\InvokePrivateMethods\Traits\InvokePrivateMethodTrait;

    private $dummyObject;

    public function setUp()
    {
        $this->dummyObject = new DummyClass();
    }

    public function testAccessPrivateMethodCallNoParam()
    {
        // Call invoke method on private function
        $result = $this->invokeMethod($this->dummyObject, 'myPrivateFunction');
        $this->assertEquals('Test Success', trim($result));
    }

    public function testAccessPrivateMethodCallWithParam()
    {
        // Call invoke method on private function
        $result = $this->invokeMethod($this->dummyObject, 'myPrivateFunction', ['Jim']);
        $this->assertEquals('Test Success Jim', trim($result));
    }

    public function testAccessPrivateMethodStaticNoParam()
    {
        // Can also be used statically
        $result = self::invoke($this->dummyObject, 'myPrivateFunction');
        $this->assertEquals('Test Success', trim($result));
    }

    public function testAccessPrivateMethodStaticWithParam()
    {
        // Can also be used statically
        $result = self::invoke($this->dummyObject, 'myPrivateFunction', ['Jim']);
        $this->assertEquals('Test Success Jim', trim($result));
    }
}
