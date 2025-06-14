<?php

namespace App\Helper;

use App\Model\Card;
use App\Model\League;
use App\Model\Player;

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
     *
     * @return array<Card>
     */
    public function draw(League $league, Player $player): array
    {
        $cards = $this->cardsForTier($league, $player);

        mt_srand($player->id + ($player->x * $this->max) + $player->y);

        $draw = [];
        for ($i = 0; $i < $this->amount; $i++) {
            $draw[] = $this->create($league, $player, $cards[array_rand($cards)]);
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
        return $card;
    }

    private function powerLevel(League $league, Player $player, Card $card): int
    {
        $nextPlayer = $player->withCard($card);

        $nextCalculation = $nextPlayer->calculation($league, $player);
        $baseCalculation = $player->calculation($league, $nextPlayer);

        $rel = static function ($a, $b) {
            if ($a <= $b) {
                return 0;
            }
            if ($a > 0 && $b > 0) {
                return $a / $b;
            }
            if ($a > 0) {
                return 1;
            }
            return 0;
        };

        $lv = $rel($nextCalculation['health'],  $baseCalculation['health'])
            + $rel($nextCalculation['damage'],  $baseCalculation['damage'])
            + $rel($nextCalculation['defense'], $baseCalculation['defense'])
            + $rel($nextCalculation['magic'],   $baseCalculation['magic'])
            + $rel($nextCalculation['speed'],   $baseCalculation['speed']);

        return (int) ($lv * 100);
    }
}
