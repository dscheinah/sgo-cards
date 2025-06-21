<?php

namespace App\Helper\Area;

class TournamentArea implements AreaInterface
{
    public static function player(array $player): array
    {
        $player['health'] = - 1000000
            + $player['health']
            + $player['damage']
            + $player['defense']
            + $player['magic']
            + $player['speed']
        ;
        $player['damage'] = 0;
        $player['magic_offense'] = 0;
        $player['speed_damage'] = 0;
        return $player;
    }

    public static function battle(array $player, array $enemy, int $duration): array
    {
        return $player;
    }
}
