<?php
namespace ksu\bizcal;

include 'Day.php';
use ksu\bizcal\Day;

class Month
{
    public int $year; 
    public int $month;
    public int $lastday;
    public int $firstwday;


    function __construct(int $year, int $month)
    {
        $t = mktime(0, 0, 0, $month, 1, $year);        
        $this->year = date('Y', $t);
        $this->month = date('n', $t);
        $this->lastday = date('t', $t);
        $this->firstwday = date('w', $t);
    }

    public static function createFromArray(array $arr)
    {
        return new Month($arr[0], $arr[1]);
    }
   
    public static function createFromString(string $ym)
    {
        $arr = self::toArray($ym);
        return self::createFromArray($arr);
    }
  
    public static function toArray(string $ym)
    {
        [$y, $m] = explode('-', $ym);
        return [(int)$y,(int)$m];
    }

    public static function toString(int $y, int $m)
    {
        return sprintf ("%d-%02d", $y, $m);
    }

    public function day(int $d)
    {
        return new Day($this->year, $this->month, $d);
    }

    public function __toString()
    {
        return self::toString($this->year, $this->month);
    }
}