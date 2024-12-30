<?php
namespace ksu\bizcal;

class BizDay implements Day
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
        return new BizDay($arr[0], $arr[1], $arr[2]);
    }
   
    public static function createFromString(string $ymd): Day
    {
        $arr = self::toArray($ymd);
        return self::createFromArray($arr);
    }
   
    public function next(int $n = 1): Day
    {
        return new BizDay($this->year, $this->month, $this->day + $n);
    }

    /**
     * check if $this day is equal to $other day
     */
    public function eq (Day $other): bool
    {
        return ($this->year == $other->year and $this->month == $other->month and $this->day == $other->day);
    }

    /**
     * check if $this day is less than or equal to $other day
     */
    public function leq (Day $other): bool
    {
        if ($this->year < $other->year) return true;
        if ($this->year == $other->year and $this->month < $other->month) return true;
        if ($this->year == $other->year and $this->month == $other->month and $this->day <= $other->day) return true;
        return false;
    }

    /**
     * check if $this day is between $day1 and $day2
     */
    public function between(Day $day1, Day $day2): bool
    {
        return $day1->leq($this) and $this->leq($day2);
    }

    /**
     * check if there is exactly one day between $this and $other day
     */
    public function sandwich(Day $other): mixed
    {
        if  ($other->eq($this->next(2))) return $this->next();
        return false;
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