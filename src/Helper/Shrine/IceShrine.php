<?php

namespace App\Helper\Shrine;

class IceShrine extends NoopShrine
{
    public static function player(array $player): array
    {
        $player['speed'] -= 20;
        if ($player['speed'] <= 0) {
            $player['speed'] = 0;
            $player['speed_damage'] = 0;
        }
        return $player;
    }
}
