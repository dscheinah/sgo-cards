<?php

namespace App\Helper\Shrine;

interface ShrineInterface
{
    public static function player(array $player): array;

    public static function battle(array $player, array $enemy): array;

    public static function stats(array $stats): array;
}
