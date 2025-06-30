<?php

namespace App\Helper\Area;

class VoidArea implements AreaInterface
{
    public static function player(array $player): array
    {
        $values = [
            $player['health'] / 10,
            $player['damage'],
            $player['defense'],
            $player['magic'],
            $player['magic_offense'],
            $player['magic_defense'],
            $player['speed'],
            $player['speed_damage'],
        ];

        shuffle($values);

        $player['health'] = $values[0] * 10;
        $player['damage'] = $values[1];
        $player['defense'] = $values[2];
        $player['magic'] = $values[3];
        $player['magic_offense'] = $values[4];
        $player['magic_defense'] = $values[5];
        $player['speed'] = $values[6];
        $player['speed_damage'] = $values[7];

        return $player;
    }

    public static function battle(array $player, array $enemy, int $duration): array
    {
        return $player;
    }
}
