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
     * {@inheritdoc}
     */
    public function tearDown()
    {
        parent::tearDown();
    }

    public function testInvokerCanBeCreated()
    {
        $this->assertInstanceOf(InvokePrivateMethod::class, $this->invoker);
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testBadMethodCall()
    {
        $this->invoker->invokeMethod($this->dummyObject, 'myMissingFunction');
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

}
