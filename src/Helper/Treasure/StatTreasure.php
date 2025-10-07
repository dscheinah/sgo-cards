<?php

namespace App\Helper\Treasure;

use App\Model\Battlefield;
use App\Model\Card;
use App\Model\Treasure;

class StatTreasure implements TreasureInterface
{
    public static function beginOfTurn(Treasure $treasure, Battlefield $battlefield): void
    {
    }

    public static function trigger(Treasure $treasure, Battlefield $battlefield): void
    {
        if (!$treasure->type) {
            return;
        }
        $calculation = $battlefield->player->calculation($battlefield->league);
        if (!isset($calculation[$treasure->type])) {
            return;
        }
        if ($calculation[$treasure->type] >= $treasure->trigger) {
            $treasure->trigger = 0;
        }
    }

    public static function levels(Treasure $treasure, Battlefield $battlefield): bool
    {
        if (!$battlefield->card) {
            return false;
        }
        return in_array($treasure->type, $battlefield->card->tags, true)
            && in_array(Card::BASE, $battlefield->card->tags, true);
    }

    public static function discard(Treasure $treasure, Card $card): bool
    {
        return false;
    }

    public static function calculation(Treasure $treasure, array $calculation): ?array
    {
        if (!$treasure->type || !isset($calculation[$treasure->type])) {
            return null;
        }
        $reduction = (int) ($treasure->power / count($calculation));
        $calculation = array_map(static fn (int $value) => max($value - $reduction, 0), $calculation);
        $calculation[$treasure->type] += $treasure->power;
        if ($calculation['health'] < 1) {
            $calculation['health'] = 1;
        }
        return $calculation;
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
