<?php
namespace ksu\bizcal;

use ksu\bizcal\BizYear;

class BizCalendar
{
    public int $year;
    public int $first_month;
    public int $first_weekday;

    function __construct(int $year, int $first_month, int $first_weekday)
    {
        $this->year = $year;
        $this->first_month = $first_month;
        $this->first_weekday = $first_weekday % 7;
    }

}