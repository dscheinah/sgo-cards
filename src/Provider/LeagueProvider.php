<?php

namespace App\Provider;

use App\Helper\ModifierHelper;
use App\Helper\ShrineHelper;
use App\Model\League;
use App\Model\LeagueStatistics;
use App\Storage\LeagueStorage;
use App\Storage\PlayerStorage;
use App\Storage\ShrineStorage;
use App\Storage\SnapshotStorage;

class LeagueProvider
{
    public function __construct(
        private readonly LeagueStorage $leagueStorage,
        private readonly PlayerStorage $playerStorage,
        private readonly ShrineStorage $shrineStorage,
        private readonly SnapshotStorage $snapshotStorage,
        private readonly ModifierHelper $modifierHelper,
        private readonly ShrineHelper $shrineHelper,
    ) {
    }

    public function createLatest(): League
    {
        $input = $this->leagueStorage->fetchLatest();
        return $this->createLeague($input);
    }

    public function create(int $id): ?League
    {
        $input = $this->leagueStorage->fetchOne($id);
        if (!$input) {
            return null;
        }
        return $this->createLeague($input);
    }

    public function createStatistics(int $id): LeagueStatistics
    {
        $statistics = new LeagueStatistics();

        foreach ($this->snapshotStorage->fetchPositionsForLeague($id) as $snapshot) {
            $statistics->statistics[$snapshot['x']][$snapshot['y']] = $snapshot['z'];
        }

        $counts = $this->playerStorage->fetchCountForLeague($id);
        $statistics->user_count = $counts['users'];
        $statistics->player_count = $counts['players'];

        foreach ($this->shrineStorage->fetchAllActive($id) as $input) {
            $shrine = $this->shrineHelper->get($input);
            if (!$shrine) {
                continue;
            }
            $statistics->shrines['positions'][$shrine->x][$shrine->y] = $shrine->color;
            $statistics->shrines['data'][$shrine->modifier] = $shrine;
        }

        return $statistics;
    }

    private function createLeague(array $input): League
    {
        $league = new League();
        $league->id = $input['id'];
        $league->modifier = $this->modifierHelper->get($input['modifier']);
        return $league;
    }
}
