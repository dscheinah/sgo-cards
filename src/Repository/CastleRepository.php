<?php

namespace App\Repository;

use App\Helper\AreaHelper;
use App\Helper\ModifierHelper;
use App\Storage\RankingStorage;
use App\Storage\TournamentStorage;
use DateTime;

class CastleRepository
{
    public function __construct(
        private readonly RankingStorage $rankingStorage,
        private readonly TournamentStorage $tournamentStorage,
        private readonly ModifierHelper $modifierHelper,
        private readonly AreaHelper $areaHelper,
        private readonly int $tiers,
    ) {
    }

    public function getRankings(?string $userId): array
    {
        $rankings = [];
        for ($tier = 0; $tier < $this->tiers; $tier++) {
            foreach ($this->rankingStorage->fetchTopThreeRankings($tier) as $ranking) {
                $rankings[$tier][$ranking['rank']] = sprintf('%s. %s', $ranking['rank'], $ranking['user_name']);
            }
            if (!$userId) {
                continue;
            }
            $userRanking = $this->rankingStorage->fetchUserRanking($tier, $userId);
            if (!$userRanking) {
                continue;
            }
            if ($userRanking > 5) {
                $rankings[$tier][] = '...';
            }
            foreach ($this->rankingStorage->fetchRankingsAround($tier, $userRanking) as $ranking) {
                $rankings[$tier][$ranking['rank']] = sprintf('%s. %s', $ranking['rank'], $ranking['user_name']);
            }
        }
        return array_map('array_values', $rankings);
    }

    public function getNextTournament(): ?array
    {
        $tournament = $this->tournamentStorage->fetchLatest();
        if (!$tournament) {
            return null;
        }
        $hours = (new DateTime($tournament['date'])->getTimestamp() - time()) / 60 / 60;
        return [
            'modifier' => $this->modifierHelper->get($tournament['modifier'])?->output(),
            'area' => $this->areaHelper->get($tournament['area'])?->output(),
            'hours' => max((int) $hours, 0),
        ];
    }
}
