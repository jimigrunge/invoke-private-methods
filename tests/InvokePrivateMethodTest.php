<?php

namespace Jimigrunge\TestHelpers\Tests;

use Jimigrunge\TestHelpers\InvokePrivateMethod;
use Jimigrunge\TestHelpers\Tests\Fixtures\DummyClass;

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

    public function testAccessPrivateMethodCallNoParam()
    {
        $this->assertInstanceOf(InvokePrivateMethod::class, $this->invoker);
        $result = $this->invoker->invokeMethod($this->dummyObject, 'myPrivateFunction');
        $this->assertEquals('Test Success', trim($result));
    }

    /**
     *
     */
    public function testAccessPrivateMethodCallWithParam()
    {
        $result = $this->invoker->invokeMethod($this->dummyObject, 'myPrivateFunction', ['Jim']);
        $this->assertEquals('Test Success Jim', trim($result));
    }

    /**
     *
     */
    public function testAccessPrivateMethodStaticNoParam()
    {
        $result = InvokePrivateMethod::invoke($this->dummyObject, 'myPrivateFunction');
        $this->assertEquals('Test Success', trim($result));
    }

    /**
     *
     */
    public function testAccessPrivateMethodStaticWithParam()
    {
        $result = InvokePrivateMethod::invoke($this->dummyObject, 'myPrivateFunction', ['Jim']);
        $this->assertEquals('Test Success Jim', trim($result));
    }

}
