<?php
include '../vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

$defs = Yaml::parseFile('holiday_def.yaml');

header("Content-Type: text/plain");
function toString($v){
    return (is_array($v)) ? '['.implode(',', $v).']' : "$v";
}

$names = $defs['HOLIDAY_NAMES'] ?? [];
for($m = 1; $m < 13; $m++){
    echo 'month: ', $m, PHP_EOL;
    if (!isset($defs[$m])) continue;
    $m_defs = $defs[$m];
    foreach ($m_defs as $def){
        $name = $def['name'] ?? '祝日';
        echo $name, PHP_EOL;
        if (isset($def['dom'])){
            echo '- dom: ', toString($def['dom']), PHP_EOL;  
        }
        if (isset($def['dow'])){
            echo '- dow: ', toString($def['dow']), PHP_EOL;
        }
        if (isset($def['with'])){
            foreach ($def['with'] as $_def){
                if (isset($_def['dom'])){
                    echo '  - dom: ', toString($_def['dom']), PHP_EOL;  
                }
                if (isset($_def['dow'])){
                    echo '  - dow: ', toString($_def['dow']), PHP_EOL;
                }        
            }
        }
        echo PHP_EOL;
    }
} 
