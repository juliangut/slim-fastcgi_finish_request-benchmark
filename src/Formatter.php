<?php

namespace Jgut\Slim\Benchmark;

class Formatter
{
    public static function formatTime($microtime, $round = 5)
    {
        $format = '%.' . $round . 'f%s';

        if ($microtime >= 1) {
            $unit = 's';
            $time = round($microtime, $round);
        } else {
            $unit = 'ms';
            $time = round($microtime * 1000);

            $format = preg_replace('/(%.[\d]+f)/', '%d', $format);
        }

        return sprintf($format, $time, $unit);
    }
}
