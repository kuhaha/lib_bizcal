<?php
include '../vendor/autoload.php';

use ksu\bizcal\BizYear;
use ksu\bizcal\BizMonth;

$hline = function($n, $c='=') { 
    return str_pad('', $n, $c); 
};
$str_hline = $hline(38, "=*") . PHP_EOL;

header("Content-Type: text/plain");
[$y, $m] = [2031, 4];
$cal = new BizYear($y, $m);
echo $cal, PHP_EOL;
foreach (range(1,4) as $n){
    $_cal = $cal->next($n);
    echo $_cal, PHP_EOL;
}

echo $str_hline;
echo 'new Month($y, $m)', PHP_EOL;
echo $str_hline;
echo "no yyyy-mm, fw, days", PHP_EOL;
echo $str_hline;
$mon = $cal->firstMonth;
foreach (range(1,16) as $i){
    echo "{$i}, {$mon}, {$mon->firstwday}, {$mon->lastday}", PHP_EOL;
    $mon = $mon->next();
}

echo $str_hline;
echo "\$mon = BizMonth::createFromArray([2024, 4])", PHP_EOL;

$mon = BizMonth::createFromArray([2024, 4]);
echo "{$mon}, {$mon->firstwday}, {$mon->lastday}", PHP_EOL;

$mon1 = $mon;

echo $str_hline;
echo "\$mon = BizMonth::createFromString('2025-10')", PHP_EOL;

$mon = BizMonth::createFromString('2025-10');
echo "{$mon}, {$mon->firstwday}, {$mon->lastday}", PHP_EOL;

echo "'{$mon}' is {$mon->diff($mon1)} months after '{$mon1}'", PHP_EOL;

echo $str_hline;
$day = $mon->day(10);
echo "\$day = \$mon->day(10)";
echo " = {$day}, {$day->wday}", PHP_EOL;

$day = $mon->day(33);
echo "\$day = \$mon->day(33)";
echo " = {$day}, {$day->wday}", PHP_EOL;

