<?php
require_once 'box.php';
require_once dirname(__DIR__) . '/../vendor/autoload.php';
use PHPUnit\Framework\TestCase;
class arrayTest extends TestCase
{
    public function testHasItemInBox()
    {
        $box = new Box(['cat', 'toy', 'torch']);

        $this->assertTrue($box->has('toy'));
        $this->assertFalse($box->has('ball'));
    }
}

$ne = new arrayTest();
$res = $ne->testHasItemInBox();
print_r($res);