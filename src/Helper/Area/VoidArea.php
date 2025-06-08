<?php

namespace App\Helper\Area;

class VoidArea implements AreaInterface
{
    public static function player(array $player): array
    {
        mt_srand();
        $player['health'] = mt_rand() % (int) $player['health'];
        $player['damage'] = mt_rand() % (int) $player['damage'];
        $player['defense'] = mt_rand() % (int) $player['defense'];
        $player['magic'] = mt_rand() % (int) $player['magic'];
        $player['magic_offense'] = mt_rand() % (int) $player['magic_offense'];
        $player['magic_defense'] = mt_rand() % (int) $player['magic_defense'];
        $player['speed'] = mt_rand() % (int) $player['speed'];
        return $player;
    }

    public static function battle(array $stats, int $duration): array
    {
        return $stats;
    }
}
