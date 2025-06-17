<?php

namespace App\Helper\Shrine;

class PowerShrine extends NoopShrine
{
    public static function speed(array $player, float $damage): float
    {
        return ($damage + $player['magic']) / 2;
    }
}
