<?php

namespace App\Helper\Shrine;

class NatureShrine extends NoopShrine
{
    public function battle(array $stats): array
    {
        $stats['health'] *= .95;
        return $stats;
    }

}
