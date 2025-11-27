<?php

namespace App\Repository;

use App\Helper\ModifierHelper;
use App\Helper\ShrineHelper;
use App\Helper\SpecializationHelper;
use App\Model\Tournament;
use App\Provider\HeroBuilder;
use App\Storage\HeroStorage;
use App\Storage\PlayerStorage;
use App\Storage\PoolStorage;

class HeroRepository
{
    public function __construct(
        private readonly HeroStorage $heroStorage,
        private readonly PlayerStorage $playerStorage,
        private readonly PoolStorage $poolStorage,
        private readonly HeroBuilder $heroBuilder,
        private readonly ModifierHelper $modifierHelper,
        private readonly ShrineHelper $shrineHelper,
        private readonly SpecializationHelper $specializationHelper,
        private readonly int $count,
    ) {
    }

    public function getAvailableModifiers(string $userId): array
    {
        $modifiers = [];
        foreach ($this->playerStorage->fetchModifiersForUser($userId) as $modifier) {
            $modifiers[] = $this->modifierHelper->get($modifier['modifier'])?->output();
        }
        $modifiers = array_filter($modifiers);
        usort($modifiers, static fn ($a, $b) => $a['text'] <=> $b['text']);
        return $modifiers;
    }

    public function getAvailableShrines(string $userId): array
    {
        $shrines = [];
        foreach ($this->poolStorage->fetchShrinesForUser($userId) as $shrine) {
            $shrines[] = $this->shrineHelper->get($shrine['identifier'])?->output();
        }
        $shrines = array_filter($shrines);
        usort($shrines, static fn ($a, $b) => $a['text'] <=> $b['text']);
        return $shrines;
    }

    public function getAvailableSpecializations(string $userId): array
    {
        $specializations = [];
        foreach ($this->poolStorage->fetchSpecializationsForUser($userId) as $specialization) {
            $specializations[] = $this->specializationHelper->get($specialization['identifier'])?->output();
        }
        $specializations = array_filter($specializations);
        usort($specializations, static fn ($a, $b) => $a['name'] <=> $b['name']);
        return $specializations;
    }

    public function getListForUser(string $userId, array $achievements, ?Tournament $tournament, ?int $heroId): array
    {
        $tier = $this->tierFromAchievements($achievements);

        if ($heroId) {
            $this->heroStorage->updateActive($userId, $heroId);
        }

        $heroes = [];
        foreach ($this->heroStorage->fetchIdsForUser($userId) as $data) {
            $heroes[] = $this->heroBuilder->load($tier, $data['id'])?->list($tournament?->modifier);
        }
        return array_pad(array_filter($heroes), $this->count, null);
    }

    public function getForUser(string $userId, array $achievements, ?int $heroId): ?array
    {
        $tier = $this->tierFromAchievements($achievements);

        if (!$heroId) {
            return $this->heroBuilder->create($tier, $userId)->output();
        }

        foreach ($this->heroStorage->fetchIdsForUser($userId) as $data) {
            if ($data['id'] === $heroId) {
                return $this->heroBuilder->load($tier, $heroId)?->output();
            }
        }
        return null;
    }

    public function getRandomEnemies(array $achievements, ?Tournament $tournament): array
    {
        $tier = $this->tierFromAchievements($achievements);

        $heroes = [];
        foreach ($this->heroStorage->fetchRandomIds($this->count * $this->count) as $data) {
            $heroes[] = $this->heroBuilder->load($tier, $data['id'])?->list($tournament?->modifier);
        }
        return array_filter($heroes);
    }

    public function save(string $userId, array $data, ?int $heroId): bool
    {
        $ids = array_column(iterator_to_array($this->heroStorage->fetchIdsForUser($userId)), 'id', 'id');
        if (!$heroId) {
            if (count($ids) >= $this->count) {
                return false;
            }
            $heroId = $this->heroStorage->create($userId);
            if (!$heroId) {
                return false;
            }
        } else if (!isset($ids[$heroId])) {
            return false;
        }

        $data['name'] = substr(strip_tags(html_entity_decode($data['name'])), 0, 23);
        $this->heroStorage->updateData($heroId, $data);

        $cards = array_filter($data['cards'], static fn (int $amount) => $amount && $amount <= 5);
        $this->heroStorage->updateAmounts($heroId, $cards);

        if (!$ids) {
            $this->heroStorage->updateActive($userId, $heroId);
        }

        return true;
    }

    public function battle(array $achievements, ?Tournament $tournament, int $heroId, int $enemyId): ?array
    {
        $tier = $this->tierFromAchievements($achievements);

        $tiers = [];
        $log = [];
        for ($i = 0; $i <= $tier; $i++) {
            $battle = $this->heroBuilder->battle($i, $heroId, $enemyId, $tournament);
            if (!$battle) {
                return null;
            }
            $tiers[] = ['winner' => $battle->winner, 'duration' => $battle->duration];
            $log[] = $battle->log;
        }

        return [
            'hero_id' => $heroId,
            'enemy_id' => $enemyId,
            'tiers' => $tiers,
            'log' => array_merge(...$log),
        ];
    }

    private function tierFromAchievements(array $achievements): int
    {
        $percentage = round(array_sum(array_column($achievements, 'value')) / count($achievements));
        if ($percentage >= 66) {
            return 2;
        }
        if ($percentage >= 33) {
            return 1;
        }
        return 0;
    }
}
