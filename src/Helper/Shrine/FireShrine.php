<?php

namespace App\Helper\Shrine;

class FireShrine extends NoopShrine
{
    public static function player(array $player): array
    {
        $player['magic_offense'] *= 1.2;
        return $player;
    }
}
