<?php

namespace App\Helper\Area;

class ForestArea implements AreaInterface
{
    public static function player(array $player): array
    {
        return $player;
    }

    public static function battle(array $player, array $enemy, int $duration): array
    {
        $player['defense'] *= .9;
        return $player;
    }
}
