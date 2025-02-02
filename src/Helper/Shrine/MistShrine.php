<?php

namespace App\Helper\Shrine;

class MistShrine extends NoopShrine
{
    public function battle(array $stats): array
    {
        mt_srand();
        if (!(mt_rand() % 5)) {
            $stats['mist_shrine'] = $stats['damage'];
            $stats['damage'] = 0;
        } else if (isset($stats['mist_shrine'])) {
            $stats['damage'] = $stats['mist_shrine'];
        }
        return $stats;
    }
}
