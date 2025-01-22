<?php

namespace App\Helper\Shrine;

class FireShrine extends NoopShrine
{
    public function player(array $player): array
    {
        $player['data']['magic_offense'] *= 1.2;
        return $player;
    }
}
