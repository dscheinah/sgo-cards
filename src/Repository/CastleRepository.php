<?php

namespace App\Repository;

use App\Storage\RankingStorage;
use App\Storage\ResultStorage;

class CastleRepository
{
    public function __construct(
        private readonly RankingStorage $rankingStorage,
        private readonly ResultStorage $resultStorage,
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

    public function getResults(string $userId): array
    {
        $results = [];
        foreach ($this->resultStorage->fetchLatest($userId) as $result) {
            $results[] = [
                'win' => $result['win'],
                'loose' => $result['loose'],
                'last' => $result['rank_before'],
                'current' => $result['rank_after'],
            ];
        }
        return $results;
    }
}
