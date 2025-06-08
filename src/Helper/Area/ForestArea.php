<?php

namespace App\Helper\Area;

class ForestArea implements AreaInterface
{
    public static function player(array $player): array
    {
        return $player;
    }

    public static function battle(array $stats, int $duration): array
    {
        $stats['defense'] *= .9;
        return $stats;
    }
}
