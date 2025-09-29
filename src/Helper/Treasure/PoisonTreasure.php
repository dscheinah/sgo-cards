<?php

namespace App\Helper\Treasure;

use App\Model\Battlefield;
use App\Model\Card;
use App\Model\Treasure;

class PoisonTreasure implements TreasureInterface
{
    public static function beginOfTurn(Treasure $treasure, Battlefield $battlefield): void
    {
        if (!$treasure->charges && !$treasure->trigger) {
            $treasure->initialize();
        }
    }

    public static function trigger(Treasure $treasure, Battlefield $battlefield): void
    {
        if ($battlefield->battle?->finished) {
            $treasure->trigger--;
        }
        self::levels($treasure, $battlefield);
    }

    public static function levels(Treasure $treasure, Battlefield $battlefield): bool
    {
        if ($battlefield->battle) {
            $treasure->experience = max($battlefield->battle->duration ** 2, $treasure->experience);
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
        if ($treasure->charges > 0) {
            $treasure->charges--;
        } else {
            $treasure->power = 0;
        }
        return null;
    }

    public static function battlePlayer(Treasure $treasure, array $player, array $enemy): ?array
    {
        return null;
    }

    public static function battleEnemy(Treasure $treasure, array $enemy, array $player): ?array
    {
        $enemy['health'] -= $treasure->power;
        return $enemy;
    }
}
