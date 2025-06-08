<?php

namespace App\Repository;

use App\Provider\LeagueProvider;
use App\Provider\PlayerProvider;
use App\Storage\PlayerStorage;

class SpecializationRepository
{
    public function __construct(
        private readonly LeagueProvider $leagueProvider,
        private readonly PlayerProvider $playerProvider,
        private readonly PlayerStorage $playerStorage,
    ) {
    }

    public function update(string $userId, int $leagueId, ?string $identifier): void
    {
        $league = $this->leagueProvider->create($leagueId);
        if (!$league) {
            return;
        }
        $player = $this->playerProvider->create($userId, $league);

        if (!$identifier) {
            $this->playerStorage->removeSpecialization($player->id);
            return;
        }

        foreach ($player->specializations as $specialization) {
            if ($specialization->identifier === $identifier) {
                break;
            }
        }
        if (!isset($specialization)) {
            return;
        }
        $this->playerStorage->updateSpecialization($player->id, $specialization->identifier);
    }
}
