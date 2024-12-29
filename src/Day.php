<?php
namespace ksu\bizcal;

interface Day
{
    public static function createFromArray(array $arr): Day;

    public static function createFromString(string $ym): Day;

    public static function toArray(string $ymd): array;
    
    public static function toString(int $y, int $m, int $d): string;
}