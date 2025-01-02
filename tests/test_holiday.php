<?php
include '../vendor/autoload.php';

use ksu\bizcal\BizHoliday;

header("Content-Type: text/plain");

$hline = function($n, $c='=') { 
    return str_pad('', $n, $c); 
};
$str_hline = $hline(38, "=*") . PHP_EOL;

echo $str_hline;
[$y, $m] = [2019, 4];
$holiday = new BizHoliday($y, $m);
echo $holiday->bzcal, PHP_EOL;
$holidays = $holiday->parse()->holidays();
print_r($holidays);


echo $str_hline;
[$y, $m] = [2031, 4];
$y = $_GET['y'] ?? $y;
$m = $_GET['m'] ?? $m;
$holiday = new BizHoliday($y, $m);
echo $holiday->bzcal, PHP_EOL;
$holidays = $holiday->parse()->holidays(3);
print_r($holidays);

echo $holiday->bzcal, PHP_EOL;
$holidays = $holiday->parse()->holidays();
print_r($holidays);
