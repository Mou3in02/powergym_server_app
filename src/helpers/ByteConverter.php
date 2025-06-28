<?php

namespace App\helpers;

class ByteConverter
{
    public static function formatBytes(int $bytes, $precision = 1)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

        if ($bytes === 0) {
            return '0 B';
        }
        if ($bytes < 0) {
            return 'Invalid size';
        }
        $base = log($bytes, 1024);
        $unitIndex = floor($base);
        // Handle cases where the size exceeds our unit array
        if ($unitIndex >= count($units)) {
            $unitIndex = count($units) - 1;
        }
        $size = round(pow(1024, $base - $unitIndex), $precision);

        return $size . ' ' . $units[$unitIndex];
    }

}