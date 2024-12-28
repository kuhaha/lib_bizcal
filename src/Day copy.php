<?php

class Day
{
    public int $year; 
    public int $month;
    public int $day;
    public int $wday;

    function __construct(int $year, int $month, int $day)
    {
        $t = mktime(0, 0, 0, $month, $day, $year);        
        $this->year = date('Y', $t);
        $this->month = date('n', $t);
        $this->day = date('d', $t);
        $this->wday = date('w', $t);
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
   
    public static function toArray(string $ymd)
    {
        [$y, $m, $d] = explode('-', $ymd);
        return [(int)$y,(int)$m, (int)$d];
    }

    public static function toString(int $y, int $m, int $d)
    {
        return sprintf ("%d-%02d-%02d", $y, $m, $d);
    }

    public function __toString()
    {
        return self::toString($this->year, $this->month, $this->day);
    }
}