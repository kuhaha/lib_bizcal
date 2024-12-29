<?php
namespace ksu\bizcal;

interface Month
{
    public static function createFromArray(array $arr): Month;

    public static function createFromString(string $ym): Month; 

    public static function toArray(string $ym): array;

    public static function toString(int $y, int $m): string;

    public function next(int $n = 1): Month;

    public function diff(Month $other): int;
    
    public function day(int $d): Day;
}