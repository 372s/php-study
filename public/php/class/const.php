<?php

// ===================== get_called_class() =======================
abstract class dbObject
{
    const TABLE_NAME = 'undefined';

    public static function GetAll()
    {
        // $c = __CLASS__; //
        $c = get_called_class(); // 后期静态绑定（"Late Static Binding"）类的名称
        return "SELECT * FROM `" . $c::TABLE_NAME . "`";
    }
}

class dbPerson extends dbObject
{
    public $do = 1;
    const TABLE_NAME = 'persons';
}

class dbAdmin extends dbPerson
{
    const TABLE_NAME = 'admins';
}

$name = 'TABLE_NAME';
var_dump(defined("dbPerson::".$name));die;
var_dump(property_exists("dbPerson", $name));die;
echo constant("dbPerson::$name");die;
echo dbPerson::GetAll() . "<br>"; //output: "SELECT * FROM `persons`"
echo dbAdmin::GetAll() . "<br>"; //output: "SELECT * FROM `admins`"




