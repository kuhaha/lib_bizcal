<?php
include '../vendor/autoload.php';

use ksu\bizcal\BizHoliday;

header("Content-Type: text/plain");
[$y, $m] = [2019, 5];

$hline = function($n, $c='=') { 
    return str_pad('', $n, $c); 
};
$str_hline = $hline(38, "=*") . PHP_EOL;

echo $str_hline;
$holiday = new BizHoliday($y, 4);
echo $holiday->bzcal, PHP_EOL;
$holidays = $holiday->parse()->holidays();
print_r($holidays);