<?php

namespace App\Helper\Treasure;

use App\Model\Battlefield;
use App\Model\Card;
use App\Model\Treasure;

interface TreasureInterface
{
    public static function beginOfTurn(Treasure $treasure, Battlefield $battlefield): void;

    public static function trigger(Treasure $treasure, Battlefield $battlefield): void;

    public static function levels(Treasure $treasure, Battlefield $battlefield): bool;

    public static function discard(Treasure $treasure, Card $card): bool;

    public static function calculation(Treasure $treasure, array $calculation): ?array;

    public static function player(Treasure $treasure, array $player): ?array;

    public static function battlePlayer(Treasure $treasure, array $player, array $enemy): ?array;

    public static function battleEnemy(Treasure $treasure, array $enemy, array $player): ?array;
}
