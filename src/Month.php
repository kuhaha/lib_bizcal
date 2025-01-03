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

    public function leq(Month $other) : bool;
    
    public function day(int $d): Day;

    public function w2mday(int $dow, int $n): int;

    public function w2mdays(int $dow): array;

    public function lastDay(): Day;
}