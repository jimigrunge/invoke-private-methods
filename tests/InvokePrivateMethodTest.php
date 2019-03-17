<?php

namespace Jimigrunge\InvokePrivateMethods\Tests;

use Jimigrunge\InvokePrivateMethods\BadMethodCallException;
use Jimigrunge\InvokePrivateMethods\InvokePrivateMethod;
use Jimigrunge\InvokePrivateMethods\Tests\Fixtures\DummyClass;
use PHPUnit\Framework\TestCase;

class InvokePrivateMethodTest extends TestCase
{
    /** @var  InvokePrivateMethod */
    private $invoker;
    /** @var  DummyClass */
    private $dummyObject;

    public function setUp(): void
    {
        $this->invoker = new InvokePrivateMethod();
        $this->dummyObject = new DummyClass();
    }

    /**
     * @covers \Jimigrunge\InvokePrivateMethods\InvokePrivateMethod::__construct
     */
    public function testInvokerCanBeCreated(): void
    {
        $this->assertInstanceOf('Jimigrunge\InvokePrivateMethods\InvokePrivateMethod', $this->invoker);
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testBadMethodCall(): void
    {
        $this->invoker->invokeMethod($this->dummyObject, 'myMissingFunction');
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testBadMethodCallWithoutObjectInVariable(): void
    {
        $this->invoker->invokeMethod(new DummyClass(), 'myMissingFunction');
    }

    /**
     * @covers \Jimigrunge\InvokePrivateMethods\InvokePrivateMethod::invokeMethod
     */
    public function testAccessPrivateMethodCallNoParam(): void
    {
        $result = $this->invoker->invokeMethod($this->dummyObject, 'myPrivateFunction');
        $this->assertEquals('Test Success', trim($result));
    }

    /**
     * @covers \Jimigrunge\InvokePrivateMethods\InvokePrivateMethod::invokeMethod
     */
    public function testAccessPrivateMethodCallWithParam(): void
    {
        $result = $this->invoker->invokeMethod($this->dummyObject, 'myPrivateFunction', ['Jim']);
        $this->assertEquals('Test Success Jim', trim($result));
    }

    /**
     * @covers \Jimigrunge\InvokePrivateMethods\InvokePrivateMethod::invoke
     */
    public function testAccessPrivateMethodStaticNoParam(): void
    {
        $result = InvokePrivateMethod::invoke($this->dummyObject, 'myPrivateFunction');
        $this->assertEquals('Test Success', trim($result));
    }

    /**
     * @covers \Jimigrunge\InvokePrivateMethods\InvokePrivateMethod::invoke
     */
    public function testAccessPrivateMethodStaticWithParam(): void
    {
        $result = InvokePrivateMethod::invoke($this->dummyObject, 'myPrivateFunction', ['Jim']);
        $this->assertEquals('Test Success Jim', trim($result));
    }

    /**
     * @covers \Jimigrunge\InvokePrivateMethods\InvokePrivateMethod::invokeMethod
     */
    public function testAccessPrivateMethodWithoutObjectInVariableNoParam(): void
    {
        $result = $this->invoker->invokeMethod(new DummyClass(), 'myPrivateFunction');
        $this->assertEquals('Test Success', trim($result));
    }

    /**
     * @covers \Jimigrunge\InvokePrivateMethods\InvokePrivateMethod::invokeMethod
     */
    public function testAccessPrivateMethodWithoutObjectInVariableWithParam(): void
    {
        $result = $this->invoker->invokeMethod(new DummyClass(), 'myPrivateFunction', ['Jim']);
        $this->assertEquals('Test Success Jim', trim($result));
    }

    /**
     * @covers \Jimigrunge\InvokePrivateMethods\InvokePrivateMethod::invoke
     */
    public function testAccessPrivateMethodStaticWithoutObjectInVariableNoParam(): void
    {
        $result = InvokePrivateMethod::invoke(new DummyClass(), 'myPrivateFunction');
        $this->assertEquals('Test Success', trim($result));
    }

    /**
     * @covers \Jimigrunge\InvokePrivateMethods\InvokePrivateMethod::invoke
     */
    public function testAccessPrivateMethodStaticWithoutObjectInVariableWithParam(): void
    {
        $result = InvokePrivateMethod::invoke(new DummyClass(), 'myPrivateFunction', ['Jim']);
        $this->assertEquals('Test Success Jim', trim($result));
    }

}
