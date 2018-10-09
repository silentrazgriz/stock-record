<?php

declare(strict_types=1);


namespace App\Component\Value;


use Carbon\Carbon;

/**
 * Class DateParser
 * @package App\Component\Value
 */
class DateParser
{
    /**
     * @param string $time
     * @return string
     */
    public static function parse(string $time)
    {
        return Carbon::parse($time)
            ->setTime(0, 0, 0)
            ->toDateTimeString();
    }

    /**
     * @return string
     */
    public static function now()
    {
        return Carbon::now()
            ->setTime(0, 0, 0)
            ->toDateTimeString();
    }
}