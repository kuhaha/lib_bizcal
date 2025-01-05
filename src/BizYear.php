<?php
namespace ksu\bizcal;

class BizYear implements Year
{
    public int $year;
    public Month $firstMonth;
    public Month $lastMonth;

    function __construct(int $year, int $first_month = 1)
    {
        ($first_month > 0 and $first_month < 13) or 
            new \InvalidArgumentException();

        $this->year = $year;
        $this->firstMonth = new BizMonth($year, $first_month);
        $this->lastMonth = new BizMonth($year, $first_month+11);
    }

    function month(int $m): Month
    {  
        $year = ($m < $this->firstMonth->month) ? $this->year+1 : $this->year;
        return new BizMonth($year, $m);
    }

    function day(int $m, $d = 1): Day
    {
        return $this->month($m)->day($d);
    }

    function next(int $n = 1): Year
    {
        return new BizYear($this->year + $n, $this->firstMonth->month);
    }

    public function __toString()
    {
        return "[{$this->firstMonth}, {$this->lastMonth}]";
    }
}