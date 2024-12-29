<?php
namespace ksu\bizcal;

class BizDate implements Day
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

    public static function createFromArray(array $arr): Day
    {
        return new BizDate($arr[0], $arr[1], $arr[2]);
    }
   
    public static function createFromString(string $ymd): Day
    {
        $arr = self::toArray($ymd);
        return self::createFromArray($arr);
    }
   
    public static function toArray(string $ymd): array
    {
        [$y, $m, $d] = explode('-', $ymd);
        return [(int)$y,(int)$m, (int)$d];
    }   

    public static function toString(int $y, int $m, int $d): string
    {
        return sprintf ("%d-%02d-%02d", $y, $m, $d);
    }

    public function __toString()
    {
        return self::toString($this->year, $this->month, $this->day);
    }
}