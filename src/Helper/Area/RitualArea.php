<?php

namespace App\Helper\Area;

class RitualArea implements AreaInterface
{
    public static function calculation(array $calculation): array
    {
        return $calculation;
    }

    public static function player(array $player): array
    {
        $value = $player['health'] * 0.5;
        $player['magic_offense'] += $value / 10;
        $player['health'] -= $value;
        return $player;
    }

    public static function battle(array $player, array $enemy, int $duration): array
    {
        return $player;
    }
}
