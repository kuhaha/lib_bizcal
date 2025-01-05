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
                    $months_for = $def['months-for'] ?? range(1,12);
                    $months_exp = $def['months-except'] ?? [];
                    $months = array_diff($months_for, $months_exp);
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

    private function isBizDay(string $name, BizDay $bzday): bool
    {
        if (array_key_exists($name, BzDef::BIZDAY_TYPE)){
            $day = $bzday->format('m-d');
            if (in_array($day, $this->bizdays[$name]??[]))
                return true;
        }
        return false;
    }

    public function isOpenDay(BizDay $bzday)
    {
        $open = $this->isBizDay('OpenDay', $bzday) || !$this->isBizDay('CloseDay', $bzday);
        $close = $this->isBizDay('CloseDay', $bzday) || !$this->isBizDay('OpenDay', $bzday);
        return (BzDef::DEFAULT_TYPE == 'OpenDay') ? $open : !$close; 
    }

    /**
     * Return next the n'th open business day starting from `$bzday` (inclusive) 
     * e.g. nextOpenday($bzday, 4): [o]x[o][o]x[o]x, return the 4th openday(bracketed)   
     *
     * @param BizDay $bzday, the day to start
     * @param integer $n, n'th openday
     * @return Day, the n'th openday from `%bzday`
     */
    public function nextOpenDay(BizDay $bzday, int $n=1): Day
    {
        $lastday = $this->lastMonth->lastDay();
        $tmp_day = $bzday;
        for ($i = 1; $i < $n; $i++){
            while (!$this->isOpenDay($tmp_day)){
                  if (!$tmp_day->leq($lastday)) return null;
                else $tmp_day = $tmp_day->next();
            }
            $tmp_day = $tmp_day->next();
        }
        return $tmp_day;
    }

}