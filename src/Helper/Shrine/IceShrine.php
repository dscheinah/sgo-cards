<?php

namespace App\Helper\Shrine;

class IceShrine extends NoopShrine
{
    public static function stats(array $stats): array
    {
        $stats['speed'] -= 20;
        return $stats;
    }
}
