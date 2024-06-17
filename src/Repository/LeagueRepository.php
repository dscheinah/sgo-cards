<?php

namespace App\Repository;

use App\Helper\Modifier;
use App\Helper\Player;
use App\Storage\LeagueStorage;
use App\Storage\PlayerStorage;
use App\Storage\SnapshotStorage;

class LeagueRepository
{
    public function __construct(
        private readonly LeagueStorage $leagueStorage,
        private readonly PlayerStorage $playerStorage,
        private readonly SnapshotStorage $snapshotStorage,
        private readonly Modifier $modifier,
        private readonly Player $player,
        private readonly int $max,
    ) {
    }

    public function getList(): array
    {
        return iterator_to_array($this->leagueStorage->fetchAllIds());
    }

    public function getInformation(int $id): ?array
    {
        $league = $this->leagueStorage->fetchOne($id);
        if (!$league) {
            return null;
        }

        $player = $this->playerStorage->fetchOneForLeagueAtY($id, $this->max);

        $statistics = [];
        foreach ($this->snapshotStorage->fetchPositionsForLeague($id) as $snapshot) {
            if (!isset($statistics[$snapshot['x']][$snapshot['y']])) {
                $statistics[$snapshot['x']][$snapshot['y']] = 0;
            }
            $statistics[$snapshot['x']][$snapshot['y']]++;
        }

        return [
            'id' => $id,
            'modifier' => $this->modifier->get($league['modifier']),
            'winner' => $player ? $this->player->get($player) : null,
            'statistics' => (object) array_map(static fn ($entry) => (object) $entry, $statistics),
        ];
    }
}
