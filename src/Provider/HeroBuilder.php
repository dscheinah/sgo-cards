<?php

namespace App\Provider;

use App\Helper\CardHelper;
use App\Helper\ModifierHelper;
use App\Helper\ShrineHelper;
use App\Helper\SpecializationHelper;
use App\Model\Hero;
use App\Storage\HeroStorage;
use App\Storage\PoolStorage;

class HeroBuilder
{
    public function __construct(
        private readonly HeroStorage $heroStorage,
        private readonly PoolStorage $poolStorage,
        private readonly CardHelper $cardHelper,
        private readonly ModifierHelper $modifierHelper,
        private readonly ShrineHelper $shrineHelper,
        private readonly SpecializationHelper $specializationHelper,
    ) {
    }

    public function load(int $tier, int $id): ?Hero
    {
        $data = $this->heroStorage->fetchOne($id);
        if (!$data) {
            return null;
        }

        $hero = new Hero();
        $hero->id = $data['id'];
        $hero->name = $data['name'];

        $hero->modifier = $this->modifierHelper->get($data['modifier']);
        $hero->shrine = $this->shrineHelper->get($data['shrine']);
        $hero->specialization = $this->specializationHelper->get($data['specialization']);

        $hero->active = (bool) $data['active'];
        $hero->tier = $tier;

        $amounts = array_column(
            iterator_to_array($this->heroStorage->fetchAmounts($id)),
            'amount',
            'identifier'
        );
        foreach ($this->poolStorage->fetchCardsForUser($data['user_id']) as $card) {
            $identifier = $card['identifier'];
            $hero = $hero->withCard($this->cardHelper->get($identifier), $amounts[$identifier] ?? 0);
        }

        return $hero;
    }

    public function create(int $tier, string $userId): Hero
    {
        $hero = new Hero();
        $hero->tier = $tier;

        foreach ($this->poolStorage->fetchCardsForUser($userId) as $card) {
            $hero = $hero->withCard($this->cardHelper->get($card['identifier']), 0);
        }

        return $hero;
    }
}
