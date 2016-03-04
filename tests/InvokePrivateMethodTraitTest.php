<?php

namespace Jimigrunge\TestHelpers\Tests;

use Jimigrunge\TestHelpers\Tests\Fixtures\DummyClass;

class InvokePrivateMethodTraitTest extends \PHPUnit_Framework_TestCase
{
    use \Jimigrunge\TestHelpers\Traits\InvokePrivateMethodTrait;

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
