<?php


// =====================  static ============================
class A
{
    const MY_CONST = false;
    public function my_const_self()
    {
        return self::MY_CONST;
    }
    public function my_const_static()
    {
        return static::MY_CONST;
    }
}

class B extends A
{
    const MY_CONST = true;
}

$b = new B();
echo $b->my_const_self() ? 'yes' : 'no' . "<br>"; // output: no
echo $b->my_const_static() ? 'yes' : 'no' . "<br>"; // output: yes


// ============================= $this ================================
class C
{
    const CONST_INT = 10;

    public function getSelf()
    {
        return self::CONST_INT;
    }

    public function getThis()
    {
        return $this::CONST_INT;
    }
}

class D extends C
{
    const CONST_INT = 20;

    public function getSelf()
    {
        return parent::getSelf();
    }

    public function getThis()
    {
        return parent::getThis();
    }
}

$d = new D();

print_r($d->getSelf()); //10
print_r($d->getThis()); //20