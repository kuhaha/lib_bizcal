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

    public function parse(array $bizday_defs = []) : array 
    {
        $bzdays = [];
        $bizday_defs = $bizday_defs ? $bizday_defs : BzDef::BIZDAY_DEF;
        foreach (['OpenDay', 'CloseDay'] as $type){
            $bzdays[$type] = [];
            foreach ($bizday_defs[$type] as $def){
                if (array_key_exists('wdays', $def)){
                    $months = $def['months'] ?? [];
                    $mdays = $this->parseWdays($def['wdays'], $months);
                    $bzdays[$type] = array_merge($bzdays[$type], $mdays);
                }
                if (array_key_exists('mdays', $def)){
                    $normalize = function (string $md): string{
                        [$m, $d] = explode('-', $md);
                        return sprintf ("%02d-%02d", $m, $d);
                    };
                    $days = array_map($normalize, $def['mdays']);
                    $bzdays[$type] = array_merge($bzdays[$type], $days);
                }
            }
            sort($bzdays[$type]);
        }
 
        return $bzdays;
    }

    private function parseWdays(array $wdays, array $months): array
    {
        $bzdays = [];
        foreach ($months as $m){
            $mon = $this->month($m);
            foreach ($wdays as $w){
                $days = $mon->w2mdays($w);
                $days = array_map(fn($d)=>sprintf("%02d-%02d", $m, $d), $days);
                $bzdays = array_merge($bzdays, $days);
            }
        }
        return $bzdays;
    }

    public function setBizDay(array $bizdays = []): self
    {
        $this->bizdays = $bizdays;
        return $this;
    }


    public function isDay(string $name, BizDay $day): bool
    {
        if (array_key_exists($name, BzDef::BIZDAY_TYPE)){ 
            if (isset($this->day_defs[$name]["$day"]))
                return true;
        }
        return false;
    }

    public function nextDay(string $name, BizDay $day, int $n=1): Day
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