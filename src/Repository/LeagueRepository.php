<?php

namespace App\Repository;

use App\Helper\Modifier;
use App\Helper\Player;
use App\Storage\LeagueStorage;
use App\Storage\PlayerStorage;
use App\Storage\SnapshotStorage;
use App\Storage\UserStorage;

class LeagueRepository
{
    public function __construct(
        private readonly LeagueStorage $leagueStorage,
        private readonly PlayerStorage $playerStorage,
        private readonly SnapshotStorage $snapshotStorage,
        private readonly UserStorage $userStorage,
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
        $leagueId = $league['id'];

        $player = $this->playerStorage->fetchOneForLeagueAtY($id, $this->max);

        $statistics = [];
        foreach ($this->snapshotStorage->fetchPositionsForLeague($id) as $snapshot) {
            if (!isset($statistics[$snapshot['x']][$snapshot['y']])) {
                $statistics[$snapshot['x']][$snapshot['y']] = 0;
            }
            $statistics[$snapshot['x']][$snapshot['y']]++;
        }

        $counts = $this->playerStorage->fetchCountForLeague($leagueId);

        $information = [
            'id' => $id,
            'modifier' => $this->modifier->get($league['modifier']),
            'statistics' => (object) array_map(static fn($entry) => (object) $entry, $statistics),
            'user_count' => $counts['users'],
            'player_count' => $counts['players'],
        ];
        if ($player) {
            $userId = $player['user_id'];
            $information['winner'] = [
                'name' => $this->userStorage->fetchOne($userId)['name'] ?? '',
                'try' => $this->playerStorage->fetchCountForUserAndLeague($userId, $leagueId),
                'player' => $this->player->get($player),
            ];
        }
        return $information;
    }
}
