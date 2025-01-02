<?php
namespace ksu\bizcal;

use ksu\bizcal\BizYear;
use ksu\bizcal\BizDay;
use ksu\bizcal\BizCalendarDef as BzDef;

class BizCalendar extends BizYear 
{
    public array $bizdays; // array[bizday_type=>array[bizday]]
    public Day $today;

    function __construct(int $year, int $first_month, array $bizday_defs=[])
    {
        parent::__construct($year, $first_month);
        $this->today = new BizDay($year, $first_month, 1);
        $this->bizdays = $this->parse($bizday_defs);
    }

    public function today(Day $day = null): Day
    {
        $this->today = $day ? $day : $this->today;
        return $this->today;
    }

    public function parse(array $bizday_defs) : array 
    {
        if ($bizday_defs){

        }
        return [];
    }
    public function setBizDay(array $bizdays = []): self
    {
        $this->bizdays = $bizdays;
        return $this;
    }


    function isDay(string $name, BizDay $day): bool
    {
        if (array_key_exists($name, BzDef::BIZDAY_TYPE)){ 
            if (isset($this->day_defs[$name]["$day"]))
                return true;
        }
        return false;
    }

    function nextDay(string $name, BizDay $day, int $n=1): Day
    {
        $lastday = $this->lastMonth->lastDay();
        $tmp_day = $day;
        for ($i=0; $i < $n; $i++){
            while (!$this->isDay($name, $tmp_day)){
                if (!$tmp_day->leq($lastday)) return null;
                else $tmp_day = $tmp_day->next();
            }

        }
        return $tmp_day;
    }

}