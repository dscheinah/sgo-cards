<?php

namespace App\Helper\Shrine;

class NoopShrine implements ShrineInterface
{
    public static function player(array $player): array
    {
        return $player;
    }

    public static function stats(array $stats): array
    {
        return $stats;
    }

    public static function speed(array $player, float $damage): float
    {
        return $damage;
    }

    public static function battle(array $stats, int $duration): array
    {
        return $stats;
    }

}
