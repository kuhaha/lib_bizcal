<?php

include_once '../src/Year.php';
include_once '../src/Month.php';

use ksu\bizcal\Year;
use ksu\bizcal\Month;
use ksu\bizcal\Day;


header("Content-Type: text/plain");
$y = 2031;
$cal = new Year($y, 10);

echo $cal, PHP_EOL;

echo "===============", PHP_EOL;
echo 'new Month($y, $m)', PHP_EOL;

echo "yyyy-mm, fw, days", PHP_EOL;
$first_month = $cal->firstMonth[1];
for ($m = $first_month; $m < $first_month + 12; $m++){
    $mon = new Month($y, $m);
    echo "{$mon}, {$mon->firstwday}, {$mon->lastday}", PHP_EOL;
}

echo "===============", PHP_EOL;
echo "\$mon = Month::createFromArray([2024, 4])", PHP_EOL;

$mon = Month::createFromArray([2024, 4]);
echo "{$mon}, {$mon->firstwday}, {$mon->lastday}", PHP_EOL;

echo "===============", PHP_EOL;
echo "\$mon = Month::createFromString('2024-10')", PHP_EOL;

$mon = Month::createFromString('2024-10');
echo "{$mon}, {$mon->firstwday}, {$mon->lastday}", PHP_EOL;

echo "===============", PHP_EOL;

$day = $mon->day(10);
echo "\$day = \$mon->day(10)";
echo " = {$day}, {$day->wday}", PHP_EOL;

$day = $mon->day(33);
echo "\$day = \$mon->day(33)";
echo " = {$day}, {$day->wday}", PHP_EOL;

