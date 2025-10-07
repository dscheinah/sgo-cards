<?php

namespace App\Helper;

use App\Model\Card;
use App\Model\League;
use App\Model\Player;
use App\Model\Treasure;

class CardHelper
{
    public function __construct(
        private readonly ModifierHelper $modifierHelper,
        private readonly array $cards,
        private readonly int $amount,
        private readonly int $max,
    ) {
    }

    /**
     * @param League $league
     * @param Player $player
     * @param array<Treasure> $treasures
     *
     * @return array<Card>
     */
    public function draw(League $league, Player $player, array $treasures = []): array
    {
        $cards = $this->cardsForTier($league, $player);

        mt_srand($player->id + ($player->x * $this->max) + $player->y);

        $draw = [];
        for ($i = 0; $i < $this->amount; $i++) {
            do {
                $card = $this->create($league, $player, $cards[array_rand($cards)]);
            } while (array_any($treasures, static fn (Treasure $treasure) => $treasure->needToRedraw($card)));
            $draw[] = $card;
        }

        return $draw;
    }

    public function pick(League $league, Player $player): Card
    {
        $cards = $this->cardsForTier($league, $player);

        mt_srand();

        $draw = [];
        for ($i = 0; $i < $this->amount; $i++) {
            $card = $this->create($league, $player, $cards[array_rand($cards)]);
            $draw[$card->value] = $card;
        }

        ksort($draw);
        return array_pop($draw);
    }

    private function cardsForTier(League $league, Player $player): array
    {
        mt_srand($league->id);

        $levelsPerTier = $this->max / count($this->cards);

        $cards = [[]];
        foreach ($this->cards as $i => $tierCards) {
            if ($i * $levelsPerTier > $player->y) {
                break;
            }
            $picked = array_filter($tierCards, static fn ($card) => !($card['league'] ?? false));
            if ($league->id > 1) {
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

    private function create(League $league, Player $player, array $input): Card
    {
        $card = new Card();
        $card->icon = $input['icon'];
        $card->text = $input['text'];
        $card->data = $input['data'] ?? [];
        $card->modifier = $this->modifierHelper->get($input['modifier'] ?? null);
        $card->value = $this->powerLevel($league, $player, $card);
        $card->tags = $input['tags'] ?? [];
        return $card;
    }

    private function powerLevel(League $league, Player $player, Card $card): int
    {
        $nextPlayer = $player->withCard($card);

        $nextCalculation = $nextPlayer->calculation($league, $player);
        $baseCalculation = $player->calculation($league, $nextPlayer);

        return max(array_sum($nextCalculation) - array_sum($baseCalculation), 0);
    }
}
