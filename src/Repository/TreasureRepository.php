<?php

namespace App\Repository;

use App\Storage\TreasureStorage;

class TreasureRepository
{
    public function __construct(
        private readonly TreasureStorage $treasureStorage,
    ) {
    }

    public function activate(string $userId, int $leagueId, array $ids): void
    {
        $this->treasureStorage->activate($userId, $leagueId, array_slice($ids, 0, 4));
    }
}
