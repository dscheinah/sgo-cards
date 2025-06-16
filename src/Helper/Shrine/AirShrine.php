<?php

namespace App\Helper\Shrine;

class AirShrine extends NoopShrine
{
    public static function player(array $player): array
    {
        $player['damage'] += $player['speed'] / 3;
        return $player;
    }

    public static function speed(array $player, float $damage): float
    {
        return $damage / 2;
    }
}
