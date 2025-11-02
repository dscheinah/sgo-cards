<?php

namespace App\Helper\Treasure;

use App\Model\Battlefield;
use App\Model\Card;
use App\Model\Treasure;

class BombTreasure implements TreasureInterface
{
    public static function beginOfTurn(Treasure $treasure, Battlefield $battlefield): void
    {
    }

    public static function trigger(Treasure $treasure, Battlefield $battlefield): void
    {
        $treasure->trigger--;
    }

    public static function levels(Treasure $treasure, Battlefield $battlefield): bool
    {
        if (!$treasure->charges) {
            $treasure->initialize();
        }
        return false;
    }

    public static function discard(Treasure $treasure, Card $card): bool
    {
        return false;
    }

    public static function calculation(Treasure $treasure, array $calculation): ?array
    {
        return null;
    }

    public static function player(Treasure $treasure, array $player): ?array
    {
        return null;
    }

    public static function battlePlayer(Treasure $treasure, array $player, array $enemy): ?array
    {
        return null;
    }

    public static function battleEnemy(Treasure $treasure, array $enemy, array $player): ?array
    {
        if (!$treasure->power || !$treasure->charges) {
            return null;
        }

        $base = 0;
        foreach ($enemy as $key => $value) {
            if ($value > $player[$key]) {
                $base++;
            }
        }
        if (!$base) {
            return null;
        }

        $enemy['health'] -= $treasure->power * $base;

        $treasure->power = 0;
        $treasure->charges--;
        $treasure->experience++;

        return $enemy;
    }
}
