<?php

define('APP_START', microtime(true));

define('ROOT_PATH', dirname(__DIR__) . '/');

define('PUBLIC_PATH', ROOT_PATH. '/public/');

require_once 'helpers.php';


class A 
{
    public function b() {
        echo 'b';
    }

    public static function abc() {
        // $this->b();
        // $a = new self();
        return (new self())->b();
    }
}
A::abc();

