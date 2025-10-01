<?php

namespace App\helpers;

class DateTimeFormatter
{
    const STANDARD_DATETIME = 'd/m/Y H:i';

    static public function format(\DateTime|string|null $datetime, ?string $format = null): string
    {
        if ($datetime === null) {
            return '-';
        }

        if (!$datetime instanceof \DateTime) {
            try {
                $datetime = new \DateTime($datetime);
            } catch (\Exception $e) {
                return '-';
            }
        }

        if (!$format) {
            $format = self::STANDARD_DATETIME;
        }

        return $datetime->format($format);
    }
}