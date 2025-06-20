<?php

namespace App\Helper\Shrine;

class IceShrine extends NoopShrine
{
    public static function stats(array $stats): array
    {
        $stats['speed'] -= 20;
        if ($stats['speed'] < 0) {
            $stats['speed'] = 0;
        }
        return $stats;
    }
}
