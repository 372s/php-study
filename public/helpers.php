<?php

$func = glob(PUBLIC_PATH . '/support/*.php');

foreach ($func as $f) {
    require_once $f;
}