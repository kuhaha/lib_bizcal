<?php
include '../vendor/autoload.php';

use ksu\bizcal\BizDay;
use ksu\bizcal\BizYear;

use Symfony\Component\Yaml\Yaml;

$defs = Yaml::parseFile('holiday_def.yaml');

header("Content-Type: text/plain");
class Holiday
{

}   

function toString($v): string{
    return is_array($v) ? '['.implode(',', $v).']' : $v;
}

function toArray($v){
    return is_scalar($v) ? [$v] : $v;
}

function since(int $y, array $years): bool{
    return $y >= $years[0];   
}
function between(int $y, array $years): bool{
    if (count($years)>1) 
        return $years[0] <= $y and $y <= $years[1];
    else return false;
}
function excluding(int $y, array $years): bool{
    return !in_array($y, $years);
}
function including(int $y, array $years): bool{
    return in_array($y, $years);
}

function valid(int $y, array $def): bool{
    $valid = $y >= 1948;
    foreach (['since', 'between', 'excluding', 'including'] as $r){
        if (isset($def[$r]))
            $valid = $valid && call_user_func($r, $y, toArray($def[$r]) );
    }
    return $valid;
}

function dow($def): void{
    echo ' dow: ', toString($def), PHP_EOL;
}
function day($def):void {
    echo ' day: ', toString($def), PHP_EOL;
}

function parseMonth(int $y, array $def){
    $name = $def['name'] ?? '祝日';     
    foreach ($def['days'] ?? [$def] as $_def){
        $ok = $y >= 1948;
        foreach (['since', 'between', 'excluding', 'including'] as $r){
            if (isset($_def[$r]))
                $ok = $ok && call_user_func($r, $y, toArray($_def[$r]));
        }
        if ($ok){
            foreach (['day','dow'] as $do){
                if (isset($_def[$do])){                    
                    call_user_func($do, $_def[$do]);
                    echo "  ★", $name, PHP_EOL;  
                }
            }
        }
    }

}
$y = $_GET['y'] ?? 2020;

echo $y, PHP_EOL;
$names = $defs['HOLIDAY_NAMES'] ?? [];
for($m = 1; $m < 13; $m++){
    echo 'month: ', $m, PHP_EOL;
    foreach ($defs[$m]??[] as $def){
        parseMonth($y, $def);
    }
} 
