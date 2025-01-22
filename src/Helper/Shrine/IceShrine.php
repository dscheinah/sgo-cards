<?php

namespace App\Helper\Shrine;

class IceShrine extends NoopShrine
{
    public function stats(array $stats): array
    {
        $stats['speed'] -= 20;
        return $stats;
    }
}
