<?php
namespace ksu\bizcal;

class Time 
{
    public int $hour;
    public int $minute;
    public int $second;

    function __construct(int $hour, int $minute = 0, int $second = 0)
    {
        $this->hour = $hour;
        $this->minute = $minute;
        $this->second = $second;
    }

    public function __toString()
    {
        return sprintf("%02d:%02d:%02d", $this->hour, $this->minute, $this->second,);
    }
}