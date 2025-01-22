<?php

namespace App\Helper\Shrine;

class WaterShrine extends NoopShrine
{
    public function player(array $player): array
    {
        $player['data']['magic_defense'] *= 2;
        return $player;
    }
}
