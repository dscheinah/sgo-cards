<?php

namespace App\Repository;

use App\Helper\CardHelper;
use App\Helper\ModifierHelper;
use App\Helper\ShrineHelper;
use App\Helper\SpecializationHelper;
use App\Helper\TreasureHelper;
use App\Model\Card;
use App\Storage\PlayerStorage;
use App\Storage\PoolStorage;
use App\Storage\SnapshotStorage;
use App\Storage\TreasureStorage;

class AchievementRepository
{
    public function __construct(
        private readonly PlayerStorage $playerStorage,
        private readonly PoolStorage $poolStorage,
        private readonly SnapshotStorage $snapshotStorage,
        private readonly TreasureStorage $treasureStorage,
        private readonly CardHelper $cardHelper,
        private readonly ModifierHelper $modifierHelper,
        private readonly ShrineHelper $shrineHelper,
        private readonly SpecializationHelper $specializationHelper,
        private readonly TreasureHelper $treasureHelper,
        private readonly int $max,
    ) {
    }

    public function getList(string $userId): array
    {
        $achievements = array_map(
            static fn ($achievement) => [
                'description' => $achievement['description'],
                'value' => min(100, ceil(100 * $achievement['value'] / $achievement['max'])),
            ],
            [
                [
                    'description' => 'Participate in 10 leagues',
                    'value' => $this->playerStorage->fetchLeagueCountForUser($userId),
                    'max' => 10,
                ],
                [
                    'description' => 'Get to x+y 175',
                    'value' => $this->playerStorage->fetchMaxLevelForUser($userId),
                    'max' => 175,
                ],
                [
                    'description' => 'Win 4 leagues',
                    'value' => $this->playerStorage->fetchWinnerCountForUser($userId, $this->max),
                    'max' => 4,
                ],
                [
                    'description' => 'Have a total of 1000 tries',
                    'value' => $this->playerStorage->fetchCountForUser($userId),
                    'max' => 1000,
                ],
                [
                    'description' => 'Pick 1000 base cards',
                    'value' => $this->poolStorage->fetchTypeCountForUser($userId, Card::BASE),
                    'max' => 1000,
                ],
                [
                    'description' => 'Pick 1000 modifier cards',
                    'value' => $this->poolStorage->fetchTypeCountForUser($userId, Card::MODIFIER),
                    'max' => 1000,
                ],
                [
                    'description' => 'Pick 1000 curse cards',
                    'value' => $this->poolStorage->fetchTypeCountForUser($userId, Card::CURSE),
                    'max' => 1000,
                ],
                [
                    'description' => 'Pick 1000 conversion cards',
                    'value' => $this->poolStorage->fetchTypeCountForUser($userId, Card::CONVERSION),
                    'max' => 1000,
                ],
                [
                    'description' => 'Pick all different cards',
                    'value' => $this->poolStorage->fetchCardCountForUser($userId),
                    'max' => $this->cardHelper->count(),
                ],
                [
                    'description' => 'See all player modifiers',
                    'value' => $this->playerStorage->fetchModifierCountForUser($userId),
                    'max' => $this->modifierHelper->countPlayer(),
                ],
                [
                    'description' => 'Have 300 total stats',
                    'value' => $this->snapshotStorage->fetchMaxTotalCalculation($userId),
                    'max' => 300,
                ],
                [
                    'description' => 'Have 600 total stats',
                    'value' => $this->snapshotStorage->fetchMaxTotalCalculation($userId),
                    'max' => 600,
                ],
                [
                    'description' => 'Have 400 total base stats',
                    'value' => $this->snapshotStorage->fetchMaxTotalBase($userId),
                    'max' => 400,
                ],
                [
                    'description' => 'Double total base stats',
                    'value' => $this->snapshotStorage->fetchMaxTotalBoost($userId),
                    'max' => 100,
                ],
                [
                    'description' => 'Triple total base stats',
                    'value' => $this->snapshotStorage->fetchMaxTotalBoost($userId),
                    'max' => 200,
                ],
                [
                    'description' => 'Place each shrine',
                    'value' => $this->poolStorage->fetchShrineCountForUser($userId),
                    'max' => $this->shrineHelper->count(),
                ],
                [
                    'description' => 'Choose all specializations',
                    'value' => $this->poolStorage->fetchSpecializationCountForUser($userId),
                    'max' => $this->specializationHelper->count(),
                ],
                [
                    'description' => 'Identify all treasures',
                    'value' => $this->treasureStorage->fetchIdentifiedCountForUser($userId),
                    'max' => $this->treasureHelper->count(),
                ],
                [
                    'description' => 'Upgrade a treasure to level 30',
                    'value' => $this->treasureStorage->fetchExperienceMaxForUserExclude($userId, 'poison'),
                    'max' => 900,
                ],
                [
                    'description' => '50 battle rounds with the matching Treasure identified',
                    'value' => $this->treasureStorage->fetchExperienceMaxForUserInclude($userId, 'poison'),
                    'max' => 2500,
                ],
                [
                    'description' => 'Defeat 1000 users with the matching Treasure identified',
                    'value' => $this->treasureStorage->fetchExperienceSumForUser($userId, 'treasure'),
                    'max' => 1000,
                ],
                [
                    'description' => 'Defeat 1000 bots with the matching Treasure identified',
                    'value' => $this->treasureStorage->fetchExperienceSumForUser($userId, 'consumable'),
                    'max' => 1000,
                ],
            ]
        );

        $amount = round(array_sum(array_column($achievements, 'value')) / count($achievements));

        return [
            'achievements' => $achievements,
            'amount' => $amount,
            'tier' => match (true) {
                $amount >= 66 => 2,
                $amount >= 33 => 1,
                default => 0,
            }
        ];
    }
}
