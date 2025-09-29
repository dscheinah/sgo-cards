<?php

namespace App\Helper\Treasure;

use App\Model\Battlefield;
use App\Model\Card;
use App\Model\Treasure;

class PotionTreasure implements TreasureInterface
{
    public static function beginOfTurn(Treasure $treasure, Battlefield $battlefield): void
    {
        if (!$treasure->charges && !$treasure->trigger) {
            $treasure->initialize();
        }
    }

    public static function trigger(Treasure $treasure, Battlefield $battlefield): void
    {
        $treasure->trigger--;
    }

    public static function levels(Treasure $treasure, Battlefield $battlefield): bool
    {
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
        if (!$treasure->power || !$treasure->charges) {
            return null;
        }

        $damage = max($enemy['damage'] - $player['defense'], 0)
            + max($enemy['magic_offense'] - $player['magic_defense'], 0);
        if ($damage < $player['health']) {
            return null;
        }

        $player['health'] += $treasure->power * 10;

        $treasure->power = 0;
        $treasure->charges--;
        $treasure->experience++;

        return $player;
    }

    public static function battleEnemy(Treasure $treasure, array $enemy, array $player): ?array
    {
        return null;
    }
}
