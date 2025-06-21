<?php

namespace App\Helper\Shrine;

class NoopShrine implements ShrineInterface
{
    public static function player(array $player): array
    {
        return $player;
    }

    public static function battle(array $player, array $enemy): array
    {
        return $player;
    }

    public static function stats(array $stats): array
    {
        return $stats;
    }
}
