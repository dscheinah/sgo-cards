<?php

namespace App\Helper;

class Card
{
    public function __construct(
        private readonly array $cards,
        private readonly int $amount,
        private readonly int $max,
    ) {
    }

    public function draw(array $player): array
    {
        mt_srand($player['id'] + ($player['x'] * $this->max) + $player['y']);

        $cards = $this->cardsForTier($player['y']);
        $count = count($cards);

        $draw = [];
        for ($i = 0; $i < $this->amount; $i++) {
            $draw[] = $cards[mt_rand() % $count];
        }
        return $draw;
    }

    public function pick(int $y): array
    {
        mt_srand();

        $cards = $this->cardsForTier($y);
        return $cards[array_rand($cards)];
    }

    private function cardsForTier(int $y): array
    {
        $levelsPerTier = $this->max / count($this->cards);

        $cards = [[]];
        foreach ($this->cards as $i => $tierCards) {
            if ($i * $levelsPerTier > $y) {
                break;
            }
            $cards[] = $tierCards;
        }

        return array_merge(...$cards);
    }
}
