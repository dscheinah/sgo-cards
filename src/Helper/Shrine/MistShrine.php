<?php

namespace App\Helper\Shrine;

class MistShrine extends NoopShrine
{
    public static function battle(array $stats, int $duration): array
    {
        if (!(mt_rand() % 5)) {
            $stats[__CLASS__] = $stats['damage'];
            $stats['damage'] = 0;
        } else if (isset($stats[__CLASS__])) {
            $stats['damage'] = $stats[__CLASS__];
            unset($stats[__CLASS__]);
        }
        return $stats;
    }
}
