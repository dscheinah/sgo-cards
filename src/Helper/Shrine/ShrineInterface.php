<?php

namespace App\Helper\Shrine;

interface ShrineInterface
{
    public static function player(array $player): array;

    public static function stats(array $stats): array;

    public static function speed(array $stats, float $damage): float;

    public static function battle(array $stats, int $duration): array;
}
