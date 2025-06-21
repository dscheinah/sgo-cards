<?php

namespace App\Helper\Area;

class CityArea implements AreaInterface
{
    public static function player(array $player): array
    {
        return $player;
    }

    public static function battle(array $player, array $enemy, int $duration): array
    {
        $player['magic_offense'] *= .85;
        return $player;
    }
}
