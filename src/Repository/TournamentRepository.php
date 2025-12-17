<?php

namespace App\Repository;

use App\Provider\HeroBuilder;
use App\Provider\TournamentProvider;
use App\Storage\HeroStorage;
use App\Storage\RankingStorage;
use App\Storage\ResultStorage;
use App\Storage\UserStorage;
use DateTimeImmutable;

class TournamentRepository
{
    public function __construct(
        private readonly HeroStorage $heroStorage,
        private readonly RankingStorage $rankingStorage,
        private readonly ResultStorage $resultStorage,
        private readonly UserStorage $userStorage,
        private readonly AchievementRepository $achievementRepository,
        private readonly TournamentProvider $tournamentProvider,
        private readonly HeroBuilder $heroBuilder,
        private readonly int $tiers,
    ) {
    }

    public function run(): void
    {
        $tournament = $this->tournamentProvider->next();
        if (!$tournament) {
            $this->tournamentProvider->create();
            return;
        }
        if ($tournament->date > new DateTimeImmutable()) {
            return;
        }

        $userTiers = [];
        foreach ($this->userStorage->fetchAllIds() as $user) {
            $userTiers[$user['id']] = $this->achievementRepository->getList($user['id'])['tier'];
        }

        $this->heroStorage->transactional(function () use ($tournament, $userTiers): bool {
            for ($tier = 0; $tier < $this->tiers; $tier++) {
                foreach ($this->heroStorage->fetchAllActive() as $heroData) {
                    if (($userTiers[$heroData['user_id']] ?? 0) < $tier) {
                        continue;
                    }

                    $win = 0;
                    $loose = 0;

                    foreach ($this->heroStorage->fetchAllActive() as $enemyData) {
                        if (($userTiers[$enemyData['user_id']] ?? 0) < $tier || $heroData['id'] === $enemyData['id']) {
                            continue;
                        }

                        $battle = $this->heroBuilder->battle($tier, $heroData['id'], $enemyData['id'], $tournament);
                        if ($battle?->winner) {
                            $win++;
                        } else {
                            $loose++;
                        }
                    }

                    $this->resultStorage->create(
                        $tournament->id,
                        $tier,
                        $heroData['user_id'],
                        $heroData['id'],
                        $win,
                        $loose,
                        $this->rankingStorage->fetchRankForUser($tier, $heroData['user_id'], $heroData['id']),
                    );
                }

                foreach ($this->resultStorage->fetchAll($tournament->id, $tier) as $result) {
                    $current = $this->rankingStorage->fetchRankForUser($tier, $result['user_id'], $result['hero_id']);
                    if ($current <= 1) {
                        continue;
                    }
                    $next = $current - 1;
                    $compare = $this->resultStorage->fetchForRank($tournament->id, $tier, $next);
                    if ($result['win'] <= ($compare['win'] ?? -1)) {
                        continue;
                    }
                    $this->rankingStorage->change($tier, $next, $result['user_id'], $result['hero_id']);
                    $this->resultStorage->updateRanking($tournament->id, $tier, $result['user_id'], $next);
                    if ($compare) {
                        $this->rankingStorage->change($tier, $current, $compare['user_id'], $compare['hero_id']);
                        $this->resultStorage->updateRanking($tournament->id, $tier, $compare['user_id'], $current);
                    }
                }
            }

            $this->tournamentProvider->create();
            return true;
        });
    }
}
