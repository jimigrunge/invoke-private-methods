<?php

namespace Jimigrunge\InvokePrivateMethods\Tests;

use Jimigrunge\InvokePrivateMethods\BadMethodCallException;
use Jimigrunge\InvokePrivateMethods\Tests\Fixtures\DummyClass;

class InvokePrivateMethodTraitTest extends \PHPUnit_Framework_TestCase
{
    use \Jimigrunge\InvokePrivateMethods\Traits\InvokePrivateMethodTrait;

    private $dummyObject;

    public function setUp()
    {
        $this->dummyObject = new DummyClass();
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testBadMethodCall()
    {
        $this->invokeMethod($this->dummyObject, 'myMissingFunction');
    }

    /**
     * @covers \Jimigrunge\InvokePrivateMethods\Traits\InvokePrivateMethodTrait::invokeMethod
     */
    public function testAccessPrivateMethodCallNoParam()
    {
        $result = $this->invokeMethod($this->dummyObject, 'myPrivateFunction');
        $this->assertEquals('Test Success', trim($result));
    }

    /**
     * @covers \Jimigrunge\InvokePrivateMethods\Traits\InvokePrivateMethodTrait::invokeMethod
     */
    public function testAccessPrivateMethodCallWithParam()
    {
        // Call invoke method on private function
        $result = $this->invokeMethod($this->dummyObject, 'myPrivateFunction', ['Jim']);
        $this->assertEquals('Test Success Jim', trim($result));
    }

    /**
     * @covers \Jimigrunge\InvokePrivateMethods\Traits\InvokePrivateMethodTrait::invoke
     */
    public function testAccessPrivateMethodStaticNoParam()
    {
        // Can also be used statically
        $result = self::invoke($this->dummyObject, 'myPrivateFunction');
        $this->assertEquals('Test Success', trim($result));
    }

    /**
     * @covers \Jimigrunge\InvokePrivateMethods\Traits\InvokePrivateMethodTrait::invoke
     */
    public function testAccessPrivateMethodStaticWithParam()
    {
        // Can also be used statically
        $result = self::invoke($this->dummyObject, 'myPrivateFunction', ['Jim']);
        $this->assertEquals('Test Success Jim', trim($result));
    }
}
