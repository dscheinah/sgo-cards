<?php

namespace App\Repository;

use App\Helper\ModifierHelper;
use App\Helper\ShrineHelper;
use App\Helper\SpecializationHelper;
use App\Storage\PlayerStorage;
use App\Storage\PoolStorage;

class HeroRepository
{
    public function __construct(
        private readonly PlayerStorage $playerStorage,
        private readonly PoolStorage $poolStorage,
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
}
