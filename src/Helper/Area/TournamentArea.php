<?php

namespace App\Helper\Area;

class TournamentArea implements AreaInterface
{
    public static function calculation(array $calculation): array
    {
        $value = array_sum($calculation) / count($calculation);
        return array_map(static fn () => $value, $calculation);
    }

    public static function player(array $player): array
    {
        return $player;
    }

    public static function battle(array $player, array $enemy, int $duration): array
    {
        return $player;
    }
}
