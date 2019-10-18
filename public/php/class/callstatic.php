<?php
header("content-type:text/html;charset=utf-8");
class Human
{
    static public $name = "妹子";
    public $height = 180;
    public $age;
    // 构造方法
    public function __construct()
    {
        $this->age = "Corwien";
        // 测试调用静态方法时，不会执行构造方法，只有实例化对象时才会触发构造函数，输出下面的内容。
        echo __LINE__, __FILE__, '<br>';
    }
    static public function tell()
    {
        echo self::$name; //静态方法调用静态属性，使用self关键词
        //echo $this->height;//错。静态方法不能调用非静态属性
        //因为 $this代表实例化对象，而这里是类，不知道 $this 代表哪个对象
    }
    public function say()
    {
        echo self::$name . "我说话了";
        //普通方法调用静态属性，同样使用self关键词
        echo $this->height;
    }
    private function eat($food, $water)
    { 
        echo $food . "\n" . $water;
    }

    static function __callStatic($name, $arguments)
    {
        // echo "Calling static method '$name' "
        //      . implode(', ', $arguments). "\n";
        $static = new static;
        return $static->$name(...$arguments);// php5.6版本以后可用，可变函数参数
    }
}

// 设置eat()方法为私有方法，外部不可调用，调用eat方法，会重载到__callStatic方法（php5.3.0版本以后可用）
// 先实例化，在调用 
// 输出：
// 13E:\laragon\www\php-study\public\php\class\callstatic.php
// a b
Human::eat('a', 'b');die;

$p1 = new Human();
$p1->say();
$p1->tell(); //对象可以访问静态方法
echo $p1::$name; //对象访问静态属性。不能这么访问$p1->name。因为静态属性的内存位置不在对象里
Human::say(); //错。say()方法有$this时出错；没有$this时能出结果。但php5.4以上会提示

/* 
 调用类的静态函数时不会自动调用类的构造函数。
测试方法，在各个函数里分别写上下面的代码 echo __LINE__,__FILE__,'<br>'; 
根据输出的内容，就知道调用顺序了。
*/
// 调用静态方法，不会执行构造方法，只有实例化对象时才会触发构造函数，输出构造方法里的内容。
Human::tell();



