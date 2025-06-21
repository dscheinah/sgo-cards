<?php

namespace App\Helper\Shrine;

class AirShrine extends NoopShrine
{
    public static function player(array $player): array
    {
        $player['damage'] += $player['speed'] / 3;
        $player['speed_damage'] /= 2;
        return $player;
    }
}
