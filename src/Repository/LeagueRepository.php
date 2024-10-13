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

        $winner = $this->playerStorage->fetchOneForLeagueAtY($id, $this->max);

        $statistics = [];
        foreach ($this->snapshotStorage->fetchPositionsForLeague($id) as $snapshot) {
            $statistics[$snapshot['x']][$snapshot['y']] = $snapshot['z'];
        }

        $counts = $this->playerStorage->fetchCountForLeague($leagueId);

        $leagueModifier = $this->modifier->get($league['modifier']);

        $information = [
            'id' => $id,
            'modifier' => $leagueModifier,
            'statistics' => (object) array_map(static fn($entry) => (object) $entry, $statistics),
            'user_count' => $counts['users'],
            'player_count' => $counts['players'],
        ];
        if ($winner) {
            $userId = $winner['user_id'];
            $player = $this->player->get($winner);
            $information['winner'] = [
                'name' => $this->userStorage->fetchOne($userId)['name'] ?? '',
                'try' => $this->playerStorage->fetchCountForUserAndLeague($userId, $leagueId),
                'player' => $player,
                'calculation' => $this->player->applyModifiers($player, null, $leagueModifier)['data'],
            ];
        }
        return $information;
    }
}
