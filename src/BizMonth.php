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

    public function leq(Month $other): bool
    {
        return $this->diff($other) <=0;
    }

    public function day(int $day): Day
    {
        return new BizDay($this->year, $this->month, $day);
    }

    /**
     * d2w(), return the day of week for the $day of the month   
     */
    public function d2w(int $day): int
    {
        return ($day -1 + $this->firstwday) % 7 ;
    }
  
    /**
     * w2d(), return the day of month for the $n'th day of week ($dow) 
     **/
    public function w2d(int $n, int $dow): int
    {
        $n = $dow >= $this->firstwday ? $n - 1 : $n; 
        $d = $n * 7 + $dow - $this->firstwday + 1;
        return ($d <= $this->lastday) ? $d : -1; 
    }

    public function __toString(): string
    {
        return self::toString($this->year, $this->month);
    }
}