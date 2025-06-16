<?php

namespace App\Helper\Area;

class RitualArea implements AreaInterface
{
    public static function player(array $player): array
    {
        $value = $player['health'] * 0.5;
        $player['magic_offense'] += $value;
        $player['health'] -= $value;
        return $player;
    }

    public static function battle(array $stats, int $duration): array
    {
        return $stats;
    }
}
