<?php

namespace App\helpers;

class DateTimeFormatter
{
    const STANDARD_DATETIME = 'd/m/Y H:i';

    static public function format(\DateTime|string|null $datetime, ?string $format = null): string
    {
        if (empty($datetime)) {
            return '-';
        }
        if (!$datetime instanceof \DateTime) {
            $datetime = new \DateTime($datetime);
        }
        if (!$format) {
            return $datetime->format(self::STANDARD_DATETIME);
        }
        try {
            return $datetime->format($format);
        } catch (\Exception $e) {
            return $date->format(self::STANDARD_DATETIME);
        }
    }
}