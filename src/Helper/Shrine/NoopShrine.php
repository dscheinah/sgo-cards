<?php

namespace App\Helper\Shrine;

class NoopShrine implements ShrineInterface
{
    public function player(array $player): array
    {
        return $player;
    }

    public function stats(array $stats): array
    {
        return $stats;
    }

    public function speed(array $stats, int $damage): int
    {
        return $damage;
    }

    public function battle(array $stats): array
    {
        return $stats;
    }

}
