<?php

namespace App\Helper\Area;

class VoidArea implements AreaInterface
{
    public static function calculation(array $calculation): array
    {
        $values = [
            $calculation['health'],
            $calculation['damage'],
            $calculation['defense'],
            $calculation['magic'],
            $calculation['speed'],
        ];

        shuffle($values);

        $calculation['health'] = max(1, $values[0]);
        $calculation['damage'] = $values[1];
        $calculation['defense'] = $values[2];
        $calculation['magic'] = $values[3];
        $calculation['speed'] = $values[4];
        return $calculation;
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
