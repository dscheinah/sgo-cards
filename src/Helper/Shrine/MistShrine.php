<?php

namespace App\Helper\Shrine;

class MistShrine extends NoopShrine
{
    public static function battle(array $stats, int $duration): array
    {
        if (!(mt_rand() % 5)) {
            $stats['mist_shrine'] = $stats['damage'];
            $stats['damage'] = 0;
        } else if (isset($stats['mist_shrine'])) {
            $stats['damage'] = $stats['mist_shrine'];
            unset($stats['mist_shrine']);
        }
        return $stats;
    }
}
