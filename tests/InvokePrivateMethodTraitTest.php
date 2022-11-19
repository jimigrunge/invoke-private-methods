<?php

namespace Jimigrunge\InvokePrivateMethods\Tests;

use Jimigrunge\InvokePrivateMethods\BadMethodCallException;
use Jimigrunge\InvokePrivateMethods\Tests\Fixtures\DummyClass;
use PHPUnit\Framework\TestCase;

class InvokePrivateMethodTraitTest extends TestCase
{
    use \Jimigrunge\InvokePrivateMethods\Traits\InvokePrivateMethodTrait;

    private $dummyObject;

    public function setUp(): void
    {
        $this->dummyObject = new DummyClass();
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testBadMethodCall(): void
    {
        $this->expectException(BadMethodCallException::class);
        $this->invokeMethod($this->dummyObject, 'myMissingFunction');
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testBadMethodCallWithoutObjectInVariable(): void
    {
        $this->expectException(BadMethodCallException::class);
        $this->invokeMethod(new DummyClass(), 'myMissingFunction');
    }

    /**
     * @covers \Jimigrunge\InvokePrivateMethods\Traits\InvokePrivateMethodTrait::invokeMethod
     */
    public function testAccessPrivateMethodCallNoParam(): void
    {
        $result = $this->invokeMethod($this->dummyObject, 'myPrivateFunction');
        $this->assertEquals('Test Success', trim($result));
    }

    /**
     * @covers \Jimigrunge\InvokePrivateMethods\Traits\InvokePrivateMethodTrait::invokeMethod
     */
    public function testAccessPrivateMethodCallWithParam(): void
    {
        // Call invoke method on private function
        $result = $this->invokeMethod($this->dummyObject, 'myPrivateFunction', ['Jim']);
        $this->assertEquals('Test Success Jim', trim($result));
    }

    /**
     * @covers \Jimigrunge\InvokePrivateMethods\Traits\InvokePrivateMethodTrait::invoke
     */
    public function testAccessPrivateMethodStaticNoParam(): void
    {
        // Can also be used statically
        $result = self::invoke($this->dummyObject, 'myPrivateFunction');
        $this->assertEquals('Test Success', trim($result));
    }

    /**
     * @covers \Jimigrunge\InvokePrivateMethods\Traits\InvokePrivateMethodTrait::invoke
     */
    public function testAccessPrivateMethodStaticWithParam(): void
    {
        // Can also be used statically
        $result = self::invoke($this->dummyObject, 'myPrivateFunction', ['Jim']);
        $this->assertEquals('Test Success Jim', trim($result));
    }

    /**
     * @covers \Jimigrunge\InvokePrivateMethods\Traits\InvokePrivateMethodTrait::invokeMethod
     */
    public function testAccessPrivateMethodCallWithoutObjectInVariableNoParam(): void
    {
        $result = $this->invokeMethod(new DummyClass(), 'myPrivateFunction');
        $this->assertEquals('Test Success', trim($result));
    }

    /**
     * @covers \Jimigrunge\InvokePrivateMethods\Traits\InvokePrivateMethodTrait::invokeMethod
     */
    public function testAccessPrivateMethodCallWithoutObjectInVariableWithParam(): void
    {
        // Call invoke method on private function
        $result = $this->invokeMethod(new DummyClass(), 'myPrivateFunction', ['Jim']);
        $this->assertEquals('Test Success Jim', trim($result));
    }

    /**
     * @covers \Jimigrunge\InvokePrivateMethods\Traits\InvokePrivateMethodTrait::invoke
     */
    public function testAccessPrivateMethodStaticWithoutObjectInVariableNoParam(): void
    {
        // Can also be used statically
        $result = self::invoke(new DummyClass(), 'myPrivateFunction');
        $this->assertEquals('Test Success', trim($result));
    }

    /**
     * @covers \Jimigrunge\InvokePrivateMethods\Traits\InvokePrivateMethodTrait::invoke
     */
    public function testAccessPrivateMethodStaticWithoutObjectInVariableWithParam(): void
    {
        // Can also be used statically
        $result = self::invoke(new DummyClass(), 'myPrivateFunction', ['Jim']);
        $this->assertEquals('Test Success Jim', trim($result));
    }
}
