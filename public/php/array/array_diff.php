<?php

$aMeetingDesc = array (
    'company_id' => 1,
    'company_product_id' => 2,
);
$aMeetingDesc2 = array (
    'company_id' => 0,
    'company_product_id' => 2,
);
print_r(array_diff_assoc($aMeetingDesc, $aMeetingDesc2));die;