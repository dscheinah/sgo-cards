<?php

namespace App\Provider;

use App\Helper\ShrineHelper;
use App\Model\LeagueStatistics;
use App\Storage\PlayerStorage;
use App\Storage\ShrineStorage;
use App\Storage\SnapshotStorage;

class StatisticProvider
{
    public function __construct(
        private readonly PlayerStorage $playerStorage,
        private readonly ShrineStorage $shrineStorage,
        private readonly SnapshotStorage $snapshotStorage,
        private readonly ShrineHelper $shrineHelper,
    ) {
    }

    public function create(int $id): LeagueStatistics
    {
        $statistics = new LeagueStatistics();

        foreach ($this->snapshotStorage->fetchPositionsForLeague($id) as $snapshot) {
            $statistics->statistics[$snapshot['x']][$snapshot['y']] = $snapshot['z'];
        }

        $counts = $this->playerStorage->fetchCountForLeague($id);
        $statistics->user_count = $counts['users'];
        $statistics->player_count = $counts['players'];

        foreach ($this->shrineStorage->fetchAllActive($id) as $input) {
            $shrine = $this->shrineHelper->create($input);
            if (!$shrine) {
                continue;
            }
            $statistics->shrines['positions'][$shrine->x][$shrine->y] = $shrine->color;
            $statistics->shrines['data'][$shrine->modifier] = $shrine;
        }

        return $statistics;
    }
}
