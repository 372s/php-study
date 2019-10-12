<?php
class A {
    static function bar() { echo get_called_class(), "\n"; }
}
class B extends A {
    static function foo() {
        parent::bar(); //forwards static info, 'B'
        call_user_func('parent::bar'); //forwarding, 'B'
        call_user_func('static::bar'); //forwarding, 'B'
        call_user_func('A::bar'); //non-forwarding, 'A'
        forward_static_call('parent::bar'); //forwarding, 'B'
        forward_static_call('A::bar'); //forwarding, 'B'
    }
}
B::foo();