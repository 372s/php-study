<?php

require __DIR__.'/autoload.php';
/**
 * 验证码
 */
use Gregwar\Captcha\CaptchaBuilder;
header('Content-type: image/jpeg');
CaptchaBuilder::create()->build()->output();
print_r(glob(dirname(__FILE__).'/*.php'));die;
