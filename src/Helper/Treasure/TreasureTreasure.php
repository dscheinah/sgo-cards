<?php

namespace App\Helper\Treasure;

use App\Model\Battlefield;
use App\Model\Card;
use App\Model\Treasure;

class TreasureTreasure implements TreasureInterface
{
    public static function beginOfTurn(Treasure $treasure, Battlefield $battlefield): void
    {
        $power = max(1, (int) ($treasure->power / 3));
        $treasure->power = 0;
        foreach ($battlefield->treasures as $dependent) {
            $dependent->power += $power;
        }
    }

    public static function trigger(Treasure $treasure, Battlefield $battlefield): void
    {
        if ($battlefield->player->x + $battlefield->player->y >= $treasure->trigger) {
            $treasure->trigger = 0;
        }
    }

    public static function levels(Treasure $treasure, Battlefield $battlefield): bool
    {
        return $battlefield->enemy && $battlefield->enemy->user_id;
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
        return null;
    }
}
