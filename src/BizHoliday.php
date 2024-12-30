<?php
namespace ksu\bizcal;

use ksu\bizcal\BizYear;
use ksu\bizcal\BizMonth;
use ksu\bizcal\BizDay;
use ksu\bizcal\BizHolidayDef as BHD;

class BizHoliday
{
    private const HOLIDAY_SINCE = 1948;
    private array $holidays = [];
    public BizYear $bzcal;

    private const DATE_FORMAT ='Y-m-d'; // '2024-01-07' for January 7, 2024 

    public function __construct(int $year, int $first_month)
    {
        $this->bzcal = new BizYear($year, $first_month);
    }

    public static function createFromBizYear(BizYear $bizcal){
        return new BizYear($bizcal->year, $bizcal->firstMonth->month);
    } 
    
    public function holidays()
    {
        return $this->holidays;
    }

    public function parse(array $holiday_defs = []): self
    {
        $holiday_defs = $holiday_defs ? $holiday_defs : BizHolidayDef::HOLIDAY_DEF; 
        if ($this->bzcal->year >= self::HOLIDAY_SINCE){
            $this->parseYear($holiday_defs)->suppHolidays()->bridgeHolidays();
        }
        return $this;
    }
    private function parseYear(array $holiday_defs = []): self
    {
        $holiday_defs = $holiday_defs ? $holiday_defs : BizHolidayDef::HOLIDAY_DEF; 
        for ($mon =$this->bzcal->firstMonth; $mon->leq($this->bzcal->lastMonth); $mon=$mon->next()){
            $year = $mon->year;
            $month = $mon->month;
            $month_defs = $holiday_defs[$month]??[]; 
            $month_holidays = $this->parseMonth($year, $month, $month_defs);
            $this->holidays = array_merge($this->holidays, $month_holidays);
        }
        ksort($this->holidays);
        return $this;
    }

    private function suppHolidays(): self
    {
        $sup_holiday = null; // 振替休日：supplemnt for holiday of Sunday
        foreach (array_keys($this->holidays) as $date){
            $day = BizDay::createFromString($date);
            if ($sup_holiday != null){
                if ($sup_holiday?->eq($day)){
                    $sup_holiday = $day->next();
                }else{
                    $this->holidays[$sup_holiday?->__toString()] = 'SubstituteHoliday';
                    $sup_holiday = null;
                }
            }
            if ($day->wday == 0) $sup_holiday = $day->next();
        }
        ksort($this->holidays);
        return $this;
    }

    private function bridgeHolidays()
    {
        $ex_holidays = []; // 国民の祝日： bridge holiday sandwiched by two holidays 
        $prev_day = null;
        foreach (array_keys($this->holidays) as $date){
            $day = BizDay::createFromString($date);
            if ($prev_day){
                $sand = $prev_day->sandwich($day);
                if ($sand){
                    $ex_holidays[$sand->__toString()] = 'BridgeHoliday';
                }
            }
            $prev_day = $day;
        }
        $this->holidays = array_merge($this->holidays, $ex_holidays);
        ksort($this->holidays);
        return $this;
    }

    /** parse holiday definitions and return an array of holidays for this month */
    private function parseMonth(int $year, int $month, array $month_defs): array
    {
        $holidays = [];
        foreach ($month_defs as $def){
            if ($this->validate($def) === false) continue;
            $day = $this->parseDay($year, $month, $def['day']);                   
            if ($day > 0){ 
                $date = BizDay::toString($year, $month, $day);
                $holidays[$date] = $def['id'];
            }                        
        }
        return $holidays;
    }

    /** 
     * parse day definition and calculate a result day 
    */
    private function parseDay(int $year, int $month, mixed $day_def): int 
    {
        $biz_month = new BizMonth($year, $month);
        if (is_integer($day_def)) return $day_def;
        if (is_array($day_def)) return $biz_month->w2d($day_def[0], $day_def[1]);
        if (in_array($day_def, ['springEquinox', 'autumnEquinox']))
            return $this->equinox($day_def);
        return -1; 
    }

    /** caculate spring and autumn equinox days  
     *  valid for years between 1851 and 2150. return -1 otherwise   
    */
    private function equinox(string $holiday='springEquinox') : int
    {
        $year = $this->bzcal->year;
        if (!$this->during($year, [1851, 2150])){
            return -1;
        }
        $delta = [20.8431, 23.2488]; // default for [1980, 2099]
        if (self::during($year, [1851, 1899]))
            $delta = [19.8277, 22.2588];
        if (self::during($year, [1900, 1979]))
            $delta = [20.8357, 23.2588];
        if (self::during($year, [2100, 2150]))
            $delta = [21.8510, 24.2488];
        
        if (!in_array($holiday, ['springEquinox', 'autumnEquinox'])){
            throw new \Exception("Unknown holiday : " . $holiday);
        }    
        $alpha = ($holiday=='springEquinox') ? $delta[0] : $delta[1];
        return (int)floor($alpha + 0.242194 * ($year - 1980) - floor(($year - 1980) / 4));
    } 

    /** check if $day definition is valid for this year  */
    private function validate(array $day_def) : bool
    {
        $valid = true;
        if (isset($day_def['during'])){
            $valid = $valid && self::during($this->bzcal->year, $day_def['during']);
        }
        if (isset($day_def['except'])){
            $valid = $valid && !in_array($this->bzcal->year, $day_def['except']);
        }
        if (isset($day_def['only'])){
            $valid = $valid && in_array($this->bzcal->year, $day_def['only']);
        }
        return $valid;
    }

    private static function during(int $a, array $range): bool 
    {
        if (sizeof($range) < 2)
            throw new \Exception("Illegal arguments! the second argument should be an array of size 2");

        return ($range[0] <= $a and $a <= $range[1]);
    }
}