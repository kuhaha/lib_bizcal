<?php
namespace ksu\bizcal;

interface Year
{
    function month(int $m): Month;
}