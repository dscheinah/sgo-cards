<?php

namespace App\Helper\Shrine;

class PowerShrine extends NoopShrine
{
    public static function player(array $player): array
    {
        if ($player['speed_damage'] > 0) {
            $player['speed_damage'] = ($player['speed_damage'] + $player['magic']) / 2;
        }
        return $player;
    }
}
