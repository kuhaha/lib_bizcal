<?php
include '../vendor/autoload.php';

use ksu\bizcal\BizCalendar;
use ksu\bizcal\BizDay;

header("Content-Type: text/plain");

$hline = function($n, $c='=') { 
    return str_pad('', $n, $c); 
};
$str_hline = $hline(38, "=*") . PHP_EOL;

[$y, $m] = [2031, 4];
$y = $_GET['y'] ?? $y;
$m = $_GET['m'] ?? $m;
$bzcal = new BizCalendar($y, $m);

$day1 = BizDay::createFromString($y . '-1-3');
$day2 = BizDay::createFromString($y . '-2-15');
$n = 3;

echo "{$day1} is OpenDay: ", $bzcal->isOpenDay($day1) ? 'True' : 'False', PHP_EOL;
echo "{$day2} is OpenDay: ", $bzcal->isOpenDay($day2) ? 'True' : 'False', PHP_EOL;
echo "nextOpenDay({$day1}, {$n}) is : {$bzcal->nextOpenDay($day1, $n)}", PHP_EOL;
echo "nextOpenDay({$day2}, {$n}) is : {$bzcal->nextOpenDay($day2, $n)}", PHP_EOL;
print_r($bzcal->parse());