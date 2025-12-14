<?php

namespace App\Helper\Area;

class CaveArea implements AreaInterface
{
    public static function calculation(array $calculation): array
    {
        return $calculation;
    }

    public static function player(array $player): array
    {
        $player['magic_defense'] += $player['defense'];
        return $player;
    }

    public static function battle(array $player, array $enemy, int $duration): array
    {
        return $player;
    }
}
