<?php

namespace App\Repository;

use App\Model\Card;
use App\Model\Treasure;
use App\Provider\BattlefieldBuilder;
use App\Storage\PlayerStorage;
use RuntimeException;

class RoundRepository
{
    public function __construct(
        private readonly BattlefieldBuilder $battlefieldBuilder,
        private readonly PlayerStorage $playerStorage,
    ) {
    }

    public function load(string $userId): ?array
    {
        $battlefield = $this->battlefieldBuilder->create($userId);
        $cards = array_map(static fn (Card $card) => $card->output(), $battlefield->cards);
        if ($battlefield->shrine) {
            $cards[0] = $battlefield->shrine->output();
        }
        return [
            'league' => [
                'id' => $battlefield->league->id,
                'modifier' => $battlefield->league->modifier?->output(),
                'area' => $battlefield->area?->output(),
            ],
            'player' => $battlefield->player->output($battlefield->league->modifier),
            'cards' => $cards,
            'treasures' => array_map(static fn (Treasure $treasure) => $treasure->output(), $battlefield->treasures),
            'shrines' => $battlefield->shrines,
        ];
    }

    public function run(string $userId, int $league, int $card): ?array
    {
        $battlefield = $this->battlefieldBuilder->create($userId);
        if ($battlefield->league->id !== $league) {
            throw new RuntimeException('league has changed');
        }

        $this->playerStorage->transactional(function () use ($battlefield, $card) {
            $this->battlefieldBuilder->fight($battlefield, $card);
            return true;
        });

        return [
            'winner' => $battlefield->battle->winner,
            'league' => $battlefield->battle->league,
            'finished' => $battlefield->battle->finished,
            'duration' => $battlefield->battle->duration,
            'enemy' => $battlefield->battle->league || $battlefield->battle->finished
                ? null
                : $battlefield->enemy->output($battlefield->league->modifier, $battlefield->player),
            'log' => $battlefield->battle->log,
        ];
    }
}
