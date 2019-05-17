<?php
require __DIR__.'/autoload.php';
/**
 * Carbon\Carbon
 */
use Carbon\Carbon;
printf("Right now is %s", Carbon::now()->toDateTimeString() . "\n");
printf("Right now in Shanghai is %s", Carbon::now());  //implicit __toString()
