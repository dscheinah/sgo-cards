<?php

namespace App\Repository;

use App\Model\Card;
use App\Provider\BattlefieldBuilder;

class RoundRepository
{
    public function __construct(
        private readonly BattlefieldBuilder $battlefieldBuilder,
    ) {
    }

    public function load(string $userId): ?array
    {
        $battlefield = $this->battlefieldBuilder->create($userId);
        $cards = array_map(static fn (Card $card) => $card->output(), $battlefield->cards);
        if ($battlefield->shrine) {
            $cards[0] = [
                'shrine' => true,
                'icon' => $battlefield->shrine->icon,
                'text' => $battlefield->shrine->text,
            ];
        }
        return [
            'league' => [
                'id' => $battlefield->league->id,
                'modifier' => $battlefield->league->modifier?->output(),
            ],
            'player' => $battlefield->player->output($battlefield->league),
            'cards' => $cards,
            'shrines' => $battlefield->shrines,
        ];
    }

    public function run(string $userId, int $league, int $card): ?array
    {
        $battlefield = $this->battlefieldBuilder->createAndFight($userId, $league, $card);
        return [
            'winner' => $battlefield->battle->winner,
            'league' => $battlefield->battle->league,
            'finished' => $battlefield->battle->finished,
            'duration' => $battlefield->battle->duration,
            'enemy' => $battlefield->battle->league || $battlefield->battle->finished
                ? null
                : $battlefield->enemy->output($battlefield->league, $battlefield->player)
        ];
    }
}
