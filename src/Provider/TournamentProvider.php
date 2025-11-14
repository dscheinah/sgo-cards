<?php

namespace App\Provider;

use App\Helper\AreaHelper;
use App\Helper\ModifierHelper;
use App\Model\Tournament;
use App\Storage\TournamentStorage;
use DateTimeImmutable;

class TournamentProvider
{
    public function __construct(
        private readonly TournamentStorage $tournamentStorage,
        private readonly ModifierHelper $modifierHelper,
        private readonly AreaHelper $areaHelper,
    ) {
    }

    public function next(): ?Tournament
    {
        $data = $this->tournamentStorage->fetchLatest();
        if (!$data) {
            return null;
        }
        $tournament = new Tournament();
        $tournament->id = $data['id'];
        $tournament->modifier = $this->modifierHelper->get($data['modifier']);
        $tournament->area = $this->areaHelper->get($data['area']);
        $tournament->date = new DateTimeImmutable($data['date']);
        return $tournament;
    }
}
