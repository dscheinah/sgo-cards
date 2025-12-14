<?php

namespace App\Helper\Area;

interface AreaInterface
{
    public static function calculation(array $calculation): array;

    public static function player(array $player): array;

    public static function battle(array $player, array $enemy, int $duration): array;
}
