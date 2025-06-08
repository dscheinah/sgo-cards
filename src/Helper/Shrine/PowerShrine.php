<?php

namespace App\Helper\Shrine;

class PowerShrine extends NoopShrine
{
    public static function speed(array $stats, float $damage): float
    {
        return $stats['magic'];
    }
}
