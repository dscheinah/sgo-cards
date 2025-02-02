<?php

namespace App\Helper;

class Card
{
    public function __construct(
        private readonly Shrine $shrine,
        private readonly array $cards,
        private readonly int $amount,
        private readonly int $max,
    ) {
    }

    public function draw(array $player, int $leagueId): array
    {
        $draw = [];
        $amount = $this->amount;

        $cards = $this->cardsForTier($player['y'], $leagueId);

        mt_srand($player['id'] + ($player['x'] * $this->max) + $player['y']);

        if ($leagueId > 9 && !(mt_rand() % 5) && !$this->shrine->isActive()) {
            $card = $this->shrine->getCard();
            if ($card) {
                $draw[] = $card;
                $amount--;
            }
        }

        for ($i = 0; $i < $amount; $i++) {
            $draw[] = $cards[array_rand($cards)];
        }
        return $draw;
    }

    public function pick(int $y, int $leagueId): array
    {
        $cards = $this->cardsForTier($y, $leagueId);
        mt_srand();
        return $cards[array_rand($cards)];
    }

    private function cardsForTier(int $y, int $leagueId): array
    {
        mt_srand($leagueId);

        $levelsPerTier = $this->max / count($this->cards);

        $cards = [[]];
        foreach ($this->cards as $i => $tierCards) {
            if ($i * $levelsPerTier > $y) {
                break;
            }
            $picked = array_filter($tierCards, static fn ($card) => !($card['league'] ?? false));
            if ($leagueId > 1) {
                $leagueCards = array_filter($tierCards, static fn ($card) => $card['league'] ?? false);
                if ($leagueCards) {
                    unset($picked[array_rand($picked)]);
                    $picked[] = $leagueCards[array_rand($leagueCards)];
                }
            }
            $cards[] = $picked;
        }

        return array_merge(...$cards);
    }
}
