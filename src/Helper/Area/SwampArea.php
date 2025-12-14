<?php

namespace App\Helper\Area;

class SwampArea implements AreaInterface
{
    public static function calculation(array $calculation): array
    {
        return $calculation;
    }

    public static function player(array $player): array
    {
        $player['speed'] = 0;
        $player['speed_damage'] = 0;
        return $player;
    }

    public static function battle(array $player, array $enemy, int $duration): array
    {
        return $player;
    }
}
