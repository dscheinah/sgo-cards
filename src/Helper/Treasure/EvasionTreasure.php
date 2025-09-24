<?php

namespace App\Helper\Treasure;

use App\Model\Battlefield;
use App\Model\Card;
use App\Model\Treasure;

class EvasionTreasure implements TreasureInterface
{
    public static function beginOfTurn(Treasure $treasure, Battlefield $battlefield): void
    {
    }

    public static function trigger(Treasure $treasure, Battlefield $battlefield): void
    {
        if (array_sum($battlefield->player->calculation($battlefield->league)) >= $treasure->trigger) {
            $treasure->trigger = 0;
        }
    }

    public static function levels(Treasure $treasure, Battlefield $battlefield): bool
    {
        return $battlefield->battle && !$battlefield->battle->winner;
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
        $player['speed_damage'] = 0;
        return $player;
    }

    public static function battlePlayer(Treasure $treasure, array $player, array $enemy): ?array
    {
        if (mt_rand() % 100 >= $treasure->power) {
            return null;
        }
        $mitigation = max($player['speed'] - $enemy['speed'], 0);
        $damage = max($enemy['damage'] - $player['defense'], 0)
            + max($enemy['magic_offense'] - $player['magic_defense'], 0);
        $player['health'] += min($mitigation, $damage);
        return $player;
    }

    public static function battleEnemy(Treasure $treasure, array $enemy, array $player): ?array
    {
        return null;
    }
}
