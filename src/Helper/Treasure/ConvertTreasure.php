<?php

namespace App\Helper\Treasure;

use App\Model\Battlefield;
use App\Model\Card;
use App\Model\Treasure;

class ConvertTreasure implements TreasureInterface
{
    public static function beginOfTurn(Treasure $treasure, Battlefield $battlefield): void
    {
    }

    public static function trigger(Treasure $treasure, Battlefield $battlefield): void
    {
        if (self::cardIsConversion($battlefield->card)) {
            $treasure->trigger--;
        }
    }

    public static function levels(Treasure $treasure, Battlefield $battlefield): bool
    {
        return self::cardIsConversion($battlefield->card);
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
        if (!$treasure->power) {
            return null;
        }
        switch ($treasure->type) {
            case 'damage':
                $source = 'damage';
                $target = 'magic_offense';
                break;
            case 'offensive_magic':
                $source = 'magic_offense';
                $target = 'damage';
                break;
            case 'defense':
                $source = 'defense';
                $target = 'magic_defense';
                break;
            case 'defensive_magic':
                $source = 'magic_defense';
                $target = 'defense';
                break;
            default:
                return null;
        }
        $amount = $player[$source] * $treasure->power / 100;
        $player[$source] -= min($amount, $player[$source]);
        $player[$target] += $amount;
        return $player;
    }


    public static function battlePlayer(Treasure $treasure, array $player, array $enemy): ?array
    {
        return null;
    }

    public static function battleEnemy(Treasure $treasure, array $enemy, array $player): ?array
    {
        return null;
    }

    private static function cardIsConversion(?Card $card = null): bool
    {
        if (!$card || !$card->modifier) {
            return false;
        }
        return str_contains($card->modifier->identifier, 'convert');
    }
}
