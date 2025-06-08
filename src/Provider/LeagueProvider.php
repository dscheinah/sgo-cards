<?php

namespace App\Provider;

use App\Helper\AreaHelper;
use App\Helper\ModifierHelper;
use App\Model\League;
use App\Storage\LeagueStorage;

class LeagueProvider
{
    public function __construct(
        private readonly LeagueStorage $leagueStorage,
        private readonly AreaHelper $areaHelper,
        private readonly ModifierHelper $modifierHelper,
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

    private function createLeague(array $input): League
    {
        $league = new League();
        $league->id = $input['id'];
        $league->modifier = $this->modifierHelper->get($input['modifier']);
        $league->areas = $this->areaHelper->get($league);
        return $league;
    }
}
