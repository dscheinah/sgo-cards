<?php

namespace App\Helper\Shrine;

class MistShrine extends NoopShrine
{
    public function battle(array $stats): array
    {
        mt_srand();
        if (!(mt_rand() % 5)) {
            $stats['damage'] = 1;
        }
        return $stats;
    }
}
