<?php
namespace ksu\bizcal;

class BizMonth implements Month
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

    public static function createFromArray(array $arr): Month
    {
        return new BizMonth($arr[0], $arr[1]);
    }
   
    public static function createFromString(string $ym): Month
    {
        $arr = self::toArray($ym);
        return self::createFromArray($arr);
    }
  
    public static function toArray(string $ym): array
    {
        [$y, $m] = explode('-', $ym);
        return [(int)$y,(int)$m];
    }

    public static function toString(int $y, int $m): string
    {
        return sprintf ("%d-%02d", $y, $m);
    }

    public function next(int $n = 1): Month
    {
        return new BizMonth($this->year, $this->month + $n);
    }

    public function diff(Month $other): int
    {
        return ($this->year-$other->year) * 12 + $this->month-$other->month; 
    }

    public function day(int $d): Day
    {
        return new BizDate($this->year, $this->month, $d);
    }

    public function __toString()
    {
        return self::toString($this->year, $this->month);
    }
}