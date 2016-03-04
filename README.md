# Test Helpers

This is a collection of classes and scripts to aid in unit testing.
I mainly use PhpUnit for all testing. I make no guaranties when it comes to other testing
utilities.

## Installation

```
$ composer require jimigrunge/test-helpers
```

## Usage

### Helper Classes

#### InvokePrivateMethod class

This class can be used to test private and protected methods.
It can be used either as a stand alone class or as a trait and called programmatically or statically.

##### As a class:
```
<?php

// Include class to call private methods
use Jimigrunge\TestHelpers\InvokePrivateMethod;

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
        $result = InvokePrivateMethod::invoke($this->dummyObject, 'myPrivateFunction', ['param1');
        $this->assertEquals('Test Success', trim($result));
    }
}
```
Once you include the class with the 'use' statement, you can utilize it on one of two ways.
You can either create an instance of `InvokePrivateMethod` and call `invokeMethod`, as in `testMyMethod()`,
or call `invoke()` statically as in `testMyMethodStatically()`

##### As a trait
```
<?php

class testclass extends \PHPUnit_Framework_TestCase
{
    use \Jimigrunge\TestHelpers\Traits\InvokePrivateMethodTrait;

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

This is basically the same but the methods now act as methods of the testing class due to the trait.

More detailed usage examples can be found by studying the tests in the `/tests` directory





## Contributing

1. Fork it!
2. Create your feature branch: `git checkout -b my-new-feature`
3. Commit your changes: `git commit -am 'Add some feature'`
4. Push to the branch: `git push origin my-new-feature`
5. Submit a pull request :D


## License

[The MIT License (MIT)]([/LICENSE.md])


