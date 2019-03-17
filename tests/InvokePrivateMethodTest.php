<?php

namespace Jimigrunge\InvokePrivateMethods\Tests;

use Jimigrunge\InvokePrivateMethods\BadMethodCallException;
use Jimigrunge\InvokePrivateMethods\InvokePrivateMethod;
use Jimigrunge\InvokePrivateMethods\Tests\Fixtures\DummyClass;

class InvokePrivateMethodTest extends \PHPUnit_Framework_TestCase
{
    /** @var  InvokePrivateMethod */
    private $invoker;
    /** @var  DummyClass */
    private $dummyObject;

    public function setUp()
    {
        $this->invoker = new InvokePrivateMethod();
        $this->dummyObject = new DummyClass();
    }

    /**
     * @covers \Jimigrunge\InvokePrivateMethods\InvokePrivateMethod::__construct
     */
    public function testInvokerCanBeCreated()
    {
        $this->assertInstanceOf('Jimigrunge\InvokePrivateMethods\InvokePrivateMethod', $this->invoker);
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testBadMethodCall()
    {
        $this->invoker->invokeMethod($this->dummyObject, 'myMissingFunction');
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testBadMethodCallWithoutObjectInVariable()
    {
        $this->invoker->invokeMethod(new DummyClass(), 'myMissingFunction');
    }

    /**
     * @covers \Jimigrunge\InvokePrivateMethods\InvokePrivateMethod::invokeMethod
     */
    public function testAccessPrivateMethodCallNoParam()
    {
        $result = $this->invoker->invokeMethod($this->dummyObject, 'myPrivateFunction');
        $this->assertEquals('Test Success', trim($result));
    }

    /**
     * @covers \Jimigrunge\InvokePrivateMethods\InvokePrivateMethod::invokeMethod
     */
    public function testAccessPrivateMethodCallWithParam()
    {
        $result = $this->invoker->invokeMethod($this->dummyObject, 'myPrivateFunction', ['Jim']);
        $this->assertEquals('Test Success Jim', trim($result));
    }

    /**
     * @covers \Jimigrunge\InvokePrivateMethods\InvokePrivateMethod::invoke
     */
    public function testAccessPrivateMethodStaticNoParam()
    {
        $result = InvokePrivateMethod::invoke($this->dummyObject, 'myPrivateFunction');
        $this->assertEquals('Test Success', trim($result));
    }

    /**
     * @covers \Jimigrunge\InvokePrivateMethods\InvokePrivateMethod::invoke
     */
    public function testAccessPrivateMethodStaticWithParam()
    {
        $result = InvokePrivateMethod::invoke($this->dummyObject, 'myPrivateFunction', ['Jim']);
        $this->assertEquals('Test Success Jim', trim($result));
    }

    /**
     * @covers \Jimigrunge\InvokePrivateMethods\InvokePrivateMethod::invokeMethod
     */
    public function testAccessPrivateMethodWithoutObjectInVariableNoParam()
    {
        $result = $this->invoker->invokeMethod(new DummyClass(), 'myPrivateFunction');
        $this->assertEquals('Test Success', trim($result));
    }

    /**
     * @covers \Jimigrunge\InvokePrivateMethods\InvokePrivateMethod::invokeMethod
     */
    public function testAccessPrivateMethodWithoutObjectInVariableWithParam()
    {
        $result = $this->invoker->invokeMethod(new DummyClass(), 'myPrivateFunction', ['Jim']);
        $this->assertEquals('Test Success Jim', trim($result));
    }

    /**
     * @covers \Jimigrunge\InvokePrivateMethods\InvokePrivateMethod::invoke
     */
    public function testAccessPrivateMethodStaticWithoutObjectInVariableNoParam()
    {
        $result = InvokePrivateMethod::invoke(new DummyClass(), 'myPrivateFunction');
        $this->assertEquals('Test Success', trim($result));
    }

    /**
     * @covers \Jimigrunge\InvokePrivateMethods\InvokePrivateMethod::invoke
     */
    public function testAccessPrivateMethodStaticWithoutObjectInVariableWithParam()
    {
        $result = InvokePrivateMethod::invoke(new DummyClass(), 'myPrivateFunction', ['Jim']);
        $this->assertEquals('Test Success Jim', trim($result));
    }

}
