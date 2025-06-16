<?php

namespace App\Helper\Area;

class SwampArea implements AreaInterface
{
    public static function player(array $player): array
    {
        $player['speed'] = 0;
        return $player;
    }

    public static function battle(array $stats, int $duration): array
    {
        return $stats;
    }
}
