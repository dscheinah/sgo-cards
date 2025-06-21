<?php

namespace App\Helper\Shrine;

class NatureShrine extends NoopShrine
{
    public static function battle(array $player, array $enemy): array
    {
        $player['health'] *= .95;
        return $player;
    }
}
