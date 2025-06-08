<?php

namespace App\Helper\Area;

class RitualArea implements AreaInterface
{
    public static function player(array $player): array
    {
        $player['magic_offense'] += $player['health'];
        return $player;
    }

    public static function battle(array $stats, int $duration): array
    {
        return $stats;
    }
}
