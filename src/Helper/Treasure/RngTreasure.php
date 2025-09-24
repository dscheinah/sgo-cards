<?php

namespace App\Helper\Treasure;

use App\Model\Battlefield;
use App\Model\Card;
use App\Model\Modifier;
use App\Model\Treasure;

class RngTreasure implements TreasureInterface
{
    public static function beginOfTurn(Treasure $treasure, Battlefield $battlefield): void
    {
    }

    public static function trigger(Treasure $treasure, Battlefield $battlefield): void
    {
        if (!$treasure->type || !$battlefield->card) {
            return;
        }
        if (self::checkCard($battlefield->card, $treasure->type)) {
            $treasure->trigger--;
        }
    }

    public static function levels(Treasure $treasure, Battlefield $battlefield): bool
    {
        if (!$treasure->type || !$battlefield->card?->modifier) {
            return false;
        }
        return self::checkModifier($battlefield->card->modifier, $treasure->type);
    }

    public static function discard(Treasure $treasure, Card $card): bool
    {
        if (!$treasure->power) {
            return false;
        }
        $treasure->power--;
        return $treasure->type && self::checkCard($card, $treasure->type);
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

    private static function checkCard(Card $card, string $type): bool
    {
        if (isset($card->data[$type])) {
            return true;
        }
        return $card->modifier && self::checkModifier($card->modifier, $type);
    }

    private static function checkModifier(Modifier $modifier, string $type): bool
    {
        return isset($modifier->data[$type]) || $modifier->source === $type || $modifier->target === $type;
    }
}
