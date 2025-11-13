<?php

namespace App\Repository;

use App\Helper\ModifierHelper;
use App\Helper\ShrineHelper;
use App\Helper\SpecializationHelper;
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
    ) {
    }

    public function getAvailableModifiers(string $userId): array
    {
        $modifiers = [];
        foreach ($this->playerStorage->fetchModifiersForUser($userId) as $modifier) {
            $modifiers[] = $this->modifierHelper->get($modifier['modifier'])?->output();
        }
        return array_filter($modifiers);
    }

    public function getAvailableShrines(string $userId): array
    {
        $shrines = [];
        foreach ($this->poolStorage->fetchShrinesForUser($userId) as $shrine) {
            $shrines[] = $this->shrineHelper->get($shrine['identifier'])?->output();
        }
        return array_filter($shrines);
    }

    public function getAvailableSpecializations(string $userId): array
    {
        $specializations = [];
        foreach ($this->poolStorage->fetchSpecializationsForUser($userId) as $specialization) {
            $specializations[] = $this->specializationHelper->get($specialization['identifier'])?->output();
        }
        return array_filter($specializations);
    }

    public function getListForUser(string $userId, array $achievements, ?int $heroId): array
    {
        $tier = $this->tierFromAchievements($achievements);

        if ($heroId) {
            $this->heroStorage->updateActive($userId, $heroId);
        }

        $heroes = [];
        foreach ($this->heroStorage->fetchIdsForUser($userId) as $data) {
            $heroes[] = $this->heroBuilder->load($tier, $data['id'])?->list(null);
        }
        return array_pad(array_filter($heroes), 3, null);
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
