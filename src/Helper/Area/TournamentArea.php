<?php

namespace App\Helper\Area;

class TournamentArea implements AreaInterface
{
    public static function player(array $player): array
    {
        $player['health'] /= 10;
        $value = array_sum($player) / count($player);

        $player = array_map(static fn () => $value, $player);
        $player['health'] *= 10;

        return $player;
    }

    public static function battle(array $player, array $enemy, int $duration): array
    {
        return $player;
    }
}
