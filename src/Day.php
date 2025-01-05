<?php
namespace ksu\bizcal;

interface Day
{
    public static function createFromArray(array $arr): Day;

    public static function createFromString(string $ymd): Day;

    public static function toArray(string $ymd): array;
    
    public static function toString(int $y, int $m, int $d): string;

    public function next(int $n = 1): Day;

    public function eq(Day $other) : bool;

    public function leq(Day $other) : bool;

    public function between(Day $day1, Day $day2) : bool;

    public function format(string $fmt): string;

    public function sandwich(Day $other): mixed;

}