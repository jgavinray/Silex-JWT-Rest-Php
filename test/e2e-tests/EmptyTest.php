<?php

class EmptyTest extends \PHPUnit_Framework_TestCase {

    public static function setUpBeforeClass() {

    }
    protected function setUp() {
    }
    protected function tearDown() {
    }
    protected function assertPreConditions() {
    }
    protected function assertPostConditions() {
    }

    public function testHelloWorld() {
        $helloWorldString = 'HelloWorld';
        $this->assertEquals($helloWorldString,'HelloWorld');
    }
}
