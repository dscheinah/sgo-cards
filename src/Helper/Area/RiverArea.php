<?php

namespace App\Helper\Area;

class RiverArea implements AreaInterface
{
    public static function calculation(array $calculation): array
    {
        return $calculation;
    }

    public static function player(array $player): array
    {
        return $player;
    }

    public static function battle(array $player, array $enemy, int $duration): array
    {
        $player['damage'] *= .9;
        return $player;
    }
}
