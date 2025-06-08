<?php

namespace App\Helper\Shrine;

class WaterShrine extends NoopShrine
{
    public static function player(array $player): array
    {
        $player['magic_defense'] *= 2;
        return $player;
    }
}
