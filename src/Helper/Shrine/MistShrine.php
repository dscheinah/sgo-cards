<?php

namespace App\Helper\Shrine;

class MistShrine extends NoopShrine
{
    public static function stats(array $stats): array
    {
        if (!(mt_rand() % 5)) {
            $stats['damage'] = 0;
        }
        return $stats;
    }
}
