<?php

namespace App\Helper\Treasure;

use App\Model\Battlefield;
use App\Model\Card;
use App\Model\Treasure;

class RngTreasure implements TreasureInterface
{
    public static function beginOfTurn(Treasure $treasure, Battlefield $battlefield): void
    {
    }

    public static function trigger(Treasure $treasure, Battlefield $battlefield): void
    {
        if (!$battlefield->card) {
            return;
        }
        if (in_array($treasure->type, $battlefield->card->tags, true)) {
            $treasure->trigger--;
        }
    }

    public static function levels(Treasure $treasure, Battlefield $battlefield): bool
    {
        if (!$battlefield->card) {
            return false;
        }
        return in_array($treasure->type, $battlefield->card->tags, true)
            && in_array(Card::MODIFIER, $battlefield->card->tags, true);
    }

    public static function discard(Treasure $treasure, Card $card): bool
    {
        if (!$treasure->power) {
            return false;
        }
        $treasure->power--;
        return $treasure->type && in_array($treasure->type, $card->tags, true);
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
