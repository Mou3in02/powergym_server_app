<?php

namespace App\helpers;

class TimeFormatter
{

    public static function format($microtime, $precision = 2, $shortFormat = true)
    {
        if ($microtime < 0) {
            return '0s';
        }

        $units = $shortFormat ?
            ['d' => 86400, 'h' => 3600, 'm' => 60, 's' => 1] :
            ['day' => 86400, 'hour' => 3600, 'minute' => 60, 'second' => 1];

        $parts = [];
        $remaining = $microtime;

        foreach ($units as $unit => $seconds) {
            if ($remaining >= $seconds) {
                $value = floor($remaining / $seconds);
                $remaining = $remaining % $seconds;

                if ($shortFormat) {
                    $parts[] = $value . $unit;
                } else {
                    $plural = $value > 1 ? 's' : '';
                    $parts[] = $value . ' ' . $unit . $plural;
                }
            }
        }

        // Handle sub-second precision
        if ($remaining > 0 && count($parts) === 0) {
            if ($remaining >= 0.001) {
                // Show milliseconds
                $ms = round($remaining * 1000, $precision);
                $parts[] = $shortFormat ? $ms . 'ms' : $ms . ' millisecond' . ($ms > 1 ? 's' : '');
            } else {
                // Show microseconds
                $us = round($remaining * 1000000, $precision);
                $parts[] = $shortFormat ? $us . 'μs' : $us . ' microsecond' . ($us > 1 ? 's' : '');
            }
        } elseif ($remaining > 0 && $remaining < 1) {
            // Add fractional seconds to the last part if it's seconds
            $lastIndex = count($parts) - 1;
            if (strpos($parts[$lastIndex], 's') !== false && !strpos($parts[$lastIndex], 'ms')) {
                $secondsValue = floatval($parts[$lastIndex]);
                $totalSeconds = $secondsValue + $remaining;

                if ($shortFormat) {
                    $parts[$lastIndex] = round($totalSeconds, $precision) . 's';
                } else {
                    $plural = $totalSeconds > 1 ? 's' : '';
                    $parts[$lastIndex] = round($totalSeconds, $precision) . ' second' . $plural;
                }
            }
        }

        return empty($parts) ? ($shortFormat ? '0s' : '0 seconds') : implode(' ', $parts);
    }

    /**
     * Format execution time with short format (default)
     */
    public static function formatShort($microtime, $precision = 2)
    {
        return self::format($microtime, $precision, true);
    }

    /**
     * Format execution time with long format
     */
    public static function formatLong($microtime, $precision = 2)
    {
        return self::format($microtime, $precision, false);
    }

}