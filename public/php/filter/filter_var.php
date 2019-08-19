<?php

var_dump(filter_var('bob@example.com', FILTER_VALIDATE_EMAIL));
var_dump(filter_var('http://www.baidu.com', FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED));
die;


$a = 'select * from table where user_id = 1118568 " and 1=1"';
// $a = '<a>2222</a>';
// echo preg_quote($a);die;
// echo addslashes(preg_quote($a));die;
echo $a .  "<br>";
echo filter_var($a, FILTER_SANITIZE_STRING) . "<br>";
// echo filter_var($a, FILTER_SANITIZE_ENCODED) . "<br>";
echo filter_var($a, FILTER_SANITIZE_MAGIC_QUOTES) . "<br>";
// echo filter_var($a, FILTER_SANITIZE_NUMBER_INT) . "<br>";
// echo filter_var($a, FILTER_SANITIZE_FULL_SPECIAL_CHARS) . "<br>";
// echo filter_var($a, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW) . "<br>";
die;


// for filters that accept options, use this format
$options = array(
    'options' => array(
        'default' => 3, // value to return if the filter fails
        // other options here
        'min_range' => 0
    ),
    'flags' => FILTER_FLAG_ALLOW_OCTAL,
);
$var = filter_var('0755', FILTER_VALIDATE_INT, $options);
echo $var;die;
// for filter that only accept flags, you can pass them directly
$var = filter_var('oops', FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

// for filter that only accept flags, you can also pass as an array
$var = filter_var('oops', FILTER_VALIDATE_BOOLEAN,
                  array('flags' => FILTER_NULL_ON_FAILURE));

// callback validate filter
function foo($value)
{
    // Expected format: Surname, GivenNames
    if (strpos($value, ", ") === false) return false;
    list($surname, $givennames) = explode(", ", $value, 2);
    $empty = (empty($surname) || empty($givennames));
    $notstrings = (!is_string($surname) || !is_string($givennames));
    if ($empty || $notstrings) {
        return false;
    } else {
        return $value;
    }
}
$var = filter_var('Doe, Jane Sue', FILTER_CALLBACK, array('options' => 'foo'));