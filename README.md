# Invoke Private Methods


[![Latest Stable Version](https://poser.pugx.org/jimigrunge/invoke-private-methods/v/stable)](https://packagist.org/packages/jimigrunge/invoke-private-methods)
[![Build Status](https://travis-ci.org/jimigrunge/invoke-private-methods.svg?branch=master)](https://travis-ci.org/jimigrunge/invoke-private-methods)
[![Coverage Status](https://coveralls.io/repos/github/jimigrunge/invoke-private-methods/badge.svg?branch=master)](https://coveralls.io/github/jimigrunge/invoke-private-methods?branch=master)
[![License](https://poser.pugx.org/jimigrunge/invoke-private-methods/license)](https://packagist.org/packages/jimigrunge/invoke-private-methods)
[![Total Downloads](https://poser.pugx.org/jimigrunge/invoke-private-methods/downloads)](https://packagist.org/packages/jimigrunge/invoke-private-methods)
![](https://reposs.herokuapp.com/?path=jimigrunge/invoke-private-methods)
[![This is a forkable respository](https://img.shields.io/badge/forkable-yes-brightgreen.svg)](https://basicallydan.github.io/forkability/?u=jimigrunge&r=invoke-private-methods)


This is a class to aid in unit testing of private methods.
It can be used either as a stand alone class or as a trait and called either programmatically or statically.

Although testing of private methods is not recommended in most cases, sometimes it is necessary.
Such as to insure correct calculations in a protected method aside form the methods that currently utilize it.
Hence this repository.

_**Note:**
I mainly use PhpUnit for all testing so I make no guaranties when it comes to other testing utilities as I have not utilized them yet._

## Installation

```
$ composer require jimigrunge/invoke-private-methods
```

### Note on version requirements

If you are using a version of PHP less than 8.1 please use the 2.0 branch 
If you are using a version of PHP less than 7.1 please use the 1.0 branch 

```
$ composer require jimigrunge/invoke-private-methods:~1.0
```

## Usage

### class InvokePrivateMethod

This class can be used to test private and protected methods.

Once you include the class with the 'use' statement, you can utilize it on one of two ways.
You can either create an instance of `InvokePrivateMethod` and call `invokeMethod`, as in `testMyMethod()`,
or call `invoke()` statically as in `testMyMethodStatically()`

```php
<?php

// Include class to call private methods
use Jimigrunge\InvokePrivateMethods\InvokePrivateMethod;

class testclass extends \PHPUnit_Framework_TestCase
{
    /** @var InvokePrivateMethod */
    private $invoker;
    private $dummyObject;

    public function setUp()
    {
        // Instantiate the class
        $this->invoker = new InvokePrivateMethod();
        $this->dummyObject = new DummyClass();
    }

    public function testMyMethod()
    {
        // Call invoke method on private function
        $result = $this->invoker->invokeMethod($this->dummyObject, 'myPrivateFunction', ['param1']);
        $this->assertEquals('Test Success', trim($result));
    }

    public function testMyMethodStatically()
    {
        // Can also be used statically
        $result = InvokePrivateMethod::invoke($this->dummyObject, 'myPrivateFunction', ['param1']);
        $this->assertEquals('Test Success', trim($result));
    }
}
```

### trait InvokePrivateMethodTrait

This trait can be used to add the functionality directly to you test class so that it can call it internally.

As with the full class usage, you can utilize it on one of two ways.
You can either call `$this->invokeMethod`, as in `testMyMethod()`,
or call `self::invoke()` statically as in `testMyMethodStatically()`


```php
<?php

// Include trait to call private methods
use Jimigrunge\InvokePrivateMethods\Traits\InvokePrivateMethodTrait;

class testclass extends \PHPUnit_Framework_TestCase
{
    use InvokePrivateMethodTrait;

    private $dummyObject;

    public function setUp()
    {
        $this->dummyObject = new DummyClass();
    }

    public function testMyMethod()
    {
        // Call invoke method on private function
        $result = $this->invokeMethod($this->dummyObject, 'myPrivateFunction', ['param1']);
        $this->assertEquals('Test Success', trim($result));
    }

    public function testMyMethodStatically()
    {
        // Can also be used statically
        $result = self::invoke($this->dummyObject, 'myPrivateFunction', ['param1']);
        $this->assertEquals('Test Success', trim($result));
    }
}
```

### Further detail

More detailed usage examples can be found by studying the tests in the `/tests` directory.


## Reporting an issue or a feature request

Issues and feature requests are tracked in the [Github issue tracker](https://github.com/jimigrunge/invoke-private-methods/issues).


## Contributing

[CONTRIBUTING.md](CONTRIBUTING.md)


## License

[The MIT License (MIT)](/LICENSE.md)


