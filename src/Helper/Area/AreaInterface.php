<?php

namespace App\Helper\Area;

interface AreaInterface
{
    public static function player(array $player): array;

    public static function battle(array $stats, int $duration): array;
}
