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

    public static function stats(array $stats): array
    {
        $stats['magic'] *= ($stats['crit'] - 1) / 2 + 1;
        return $stats;
    }
}
