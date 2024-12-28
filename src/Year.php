<?php
namespace ksu\bizcal;

include 'Month.php';
use ksu\bizcal\Month;

class Year
{
    public int $year;
    public array $firstMonth;
    public array $lastMonth;

    function __construct(int $year, int $first_month = 1)
    {
        $this->year = $year;
        $this->firstMonth = [$year, $first_month];
        $t = mktime(0, 0, 0, $first_month+11, 1, $year);
        $this->lastMonth = [date('Y', $t), date('n', $t)];
    }

    function month(int $m)
    {
        $y =  $m < $this->firstMonth ? $this->year+1 : $this->year;   
        return new Month($y, $m);
    }

    public function __toString()
    {
        return vsprintf("[%d-%02d,", $this->firstMonth) .
            vsprintf("%d-%02d]", $this->lastMonth);

    }
}