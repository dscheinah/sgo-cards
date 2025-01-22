<?php

namespace App\Helper\Shrine;

class PowerShrine extends NoopShrine
{
    public function speed(array $stats, int $damage): int
    {
        return $stats['magic'];
    }
}
