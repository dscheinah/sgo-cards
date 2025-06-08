<?php

namespace App\Repository;

use App\Model\Modifier;
use App\Model\Shrine;
use App\Provider\LeagueProvider;
use App\Provider\PlayerProvider;
use App\Storage\LeagueStorage;

class LeagueRepository
{
    public function __construct(
        private readonly LeagueStorage $leagueStorage,
        private readonly LeagueProvider $leagueProvider,
        private readonly PlayerProvider $playerProvider,
    ) {
    }

    public function getList(): array
    {
        return iterator_to_array($this->leagueStorage->fetchAllIds());
    }

    public function getInformation(int $id): ?array
    {
        $league = $this->leagueProvider->create($id);
        if (!$league) {
            return null;
        }
        $statistics = $this->leagueProvider->createStatistics($id);

        return [
            'id' => $league->id,
            'modifier' => $league->modifier?->output(),
            'statistics' => (object) array_map(static fn($entry) => (object) $entry, $statistics->statistics),
            'shrines' => [
                'positions' => (object) array_map(static fn($entry) => (object) $entry, $statistics->shrines['positions']),
                'data' => array_map(
                    static fn (Shrine $shrine) => $shrine->output(),
                    array_values($statistics->shrines['data']),
                ),
            ],
            'user_count' => $statistics->user_count,
            'player_count' => $statistics->player_count,
            'winner' => $this->playerProvider->createWinner($league)?->output($league),
        ];
    }
}
