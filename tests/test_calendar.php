<?php
include '../vendor/autoload.php';

use ksu\bizcal\BizCalendar;

header("Content-Type: text/plain");

$hline = function($n, $c='=') { 
    return str_pad('', $n, $c); 
};
$str_hline = $hline(38, "=*") . PHP_EOL;

[$y, $m] = [2031, 4];
$y = $_GET['y'] ?? $y;
$m = $_GET['m'] ?? $m;
$bzcal = new BizCalendar($y, $m);
print_r($bzcal->parse());