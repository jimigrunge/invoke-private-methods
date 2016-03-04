<?php

namespace Jimigrunge\TestHelpers\Traits;

/**
 * Class InvokePrivateMethodTrait
 * @package Jimigrunge\TestHelpers
 */
trait InvokePrivateMethodTrait
{
    /**
     * Call protected/private method of a class.
     *
     * @param object &$object Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     */
    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        return self::invoke($object, $methodName, $parameters);
    }

    /**
     * Call protected/private method of a class statically.
     *
     * @param $object
     * @param $methodName
     * @param array $parameters
     *
     * @return mixed
     */
    public static function invoke(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}
