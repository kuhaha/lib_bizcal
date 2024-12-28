<?php
namespace ksu\bizcal;

class Time 
{
    public int $hour;
    public int $minute;
    public int $second;
    public int $day; // days for time exceeding 24 hours

    function __construct(int $hour, int $minute = 0, int $second = 0)
    {
        $this->hour = $hour % 24;
        $this->minute = $minute % 60;
        $this->second = $second % 60;
        $this->day = (int)($hour + ($minute+ $second/60)/60) / 24;
    }

    public function __toString()
    {
        return sprintf("%02d:%02d:%02d", $this->hour,$this->minute,$this->second,);

    }
}