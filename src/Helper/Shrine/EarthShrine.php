<?php

namespace App\Helper\Shrine;

class EarthShrine extends NoopShrine
{
    public static function player(array $player): array
    {
        $player['damage'] += $player['defense'] / 3;
        return $player;
    }
}
