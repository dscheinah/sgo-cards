<?php

namespace App\Storage;

use App\Model\Card;
use App\Model\Shrine;
use App\Model\Specialization;
use Generator;
use Sx\Data\Storage;

class PoolStorage extends Storage
{
    public function insertCard(string $userId, Card $card): void
    {
        $type = current(array_intersect($card->tags, [Card::BASE, Card::MODIFIER, Card::CURSE, Card::CONVERSION])) ?: '';

        $statement = 'INSERT INTO `pool_cards` (`user_id`, `identifier`, `type`, `tier`) VALUES (?, ?, ?, ?) 
            ON DUPLICATE KEY UPDATE `type` = ?, `tier` = ?, `count` = `count` + 1';
        $this->insert($statement, [$userId, $card->identifier, $type, $card->tier, $type, $card->tier]);
    }

    public function insertShrine(string $userId, Shrine $shrine): void
    {
        $statement = 'INSERT IGNORE INTO `pool_shrines` (`user_id`, `identifier`) VALUES (?, ?)';
        $this->insert($statement, [$userId, $shrine->modifier]);
    }

    public function insertSpecialization(string $userId, Specialization $specialization): void
    {
        $statement = 'INSERT IGNORE INTO `pool_specializations` (`user_id`, `identifier`) VALUES (?, ?)';
        $this->insert($statement, [$userId, $specialization->identifier]);
    }

    public function fetchCardCountForUser(string $userId): int
    {
        $statement = 'SELECT COUNT(*) AS `count` FROM `pool_cards` WHERE `user_id` = ?';
        return $this->fetch($statement, [$userId])->current()['count'] ?? 0;
    }

    public function fetchTypeCountForUser(string $userId, string $tag): int
    {
        $statement = 'SELECT SUM(`count`) AS `sum` FROM `pool_cards` WHERE `user_id` = ? AND `type` = ?';
        return $this->fetch($statement, [$userId, $tag])->current()['sum'] ?? 0;
    }

    public function fetchShrineCountForUser(string $userId): int
    {
        $statement = 'SELECT COUNT(*) AS `count` FROM `pool_shrines` WHERE `user_id` = ?';
        return $this->fetch($statement, [$userId])->current()['count'] ?? 0;
    }

    public function fetchShrinesForUser(string $userId): Generator
    {
        $statement = 'SELECT `identifier` FROM `pool_shrines` WHERE `user_id` = ?';
        return $this->fetch($statement, [$userId]);
    }

    public function fetchSpecializationCountForUser(string $userId): int
    {
        $statement = 'SELECT COUNT(*) AS `count` FROM `pool_specializations` WHERE `user_id` = ?';
        return $this->fetch($statement, [$userId])->current()['count'] ?? 0;
    }

    public function fetchSpecializationsForUser(string $userId): Generator
    {
        $statement = 'SELECT `identifier` FROM `pool_specializations` WHERE `user_id` = ?';
        return $this->fetch($statement, [$userId]);
    }
}
