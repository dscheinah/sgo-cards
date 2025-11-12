<?php

namespace App\Model;

class Hero
{
    public int $id = 0;

    public string $name = '';

    public ?Modifier $modifier = null;

    public ?Shrine $shrine = null;

    public ?Specialization $specialization = null;

    public bool $active = false;

    public int $tier = 0;

    /** @var array<int, array<string, array{card: Card, amount: int}>> */
    public array $cards = [[], [], [], [], [], [], [], []];

    public function withCard(?Card $card, int $amount): Hero
    {
        if (!$card) {
            return $this;
        }
        $hero = clone $this;
        $hero->cards[$card->tier][$card->identifier] = [
            'card' => $card,
            'amount' => $amount,
        ];
        return $hero;
    }

    public function player(int $tier): ?Player
    {
        if ($this->tier < $tier) {
            return null;
        }

        $cards = array_merge(
            ...array_filter(
                $this->cards,
                static fn ($index) => !(($tier === 0 && $index > 2) || ($tier === 1 && $index > 4)),
                ARRAY_FILTER_USE_KEY
            )
        );

        $affinities = [];
        foreach ($cards as $entry) {
            foreach ($entry['card']->tags as $tag) {
                if (isset($affinities[$tag])) {
                    $affinities[$tag]++;
                } else {
                    $affinities[$tag] = 1;
                }
            }
        }

        $player = new Player();
        $player->modifier = $this->modifier;
        if ($tier > 0) {
            $player->specialization = $this->specialization;
        }
        foreach ($cards as $entry) {
            for ($i = 0; $i < $entry['amount']; $i++) {
                $affinity = 0;
                foreach ($entry['card']->tags as $tag) {
                    if ($affinities[$tag] ?? 0 > $affinity) {
                        $affinity = $affinities[$tag];
                    }
                }
                $affinity = ($affinity + 100) / 100;

                $card = clone $entry['card'];
                $card->data = array_map(static fn ($value) => $value * $affinity, $card->data);
                if ($card->modifier) {
                    $card->modifier = clone $card->modifier;
                    $card->modifier->data = array_map(
                        static fn ($value) => $card->modifier->multiplicative && $value < 1
                            ? $value / $affinity
                            : $value * $affinity,
                        $card->modifier->data
                    );
                }
                $player = $player->withCard($card);
            }
        }
        return $player;
    }

    public function list(?Modifier $global): array
    {
        $tiers = [];
        for ($tier = 0; $tier <= $this->tier; ++$tier) {
            $player = $this->player($tier);
            if (!$player) {
                break;
            }
            $tiers[] = [...$player->calculation($global), 'curse' => $player->curse];
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'tiers' => $tiers,
            'shrine' => $this->shrine?->output(),
            'specialization' => $this->specialization?->output(),
            'active' => $this->active,
        ];
    }

    public function output(): array
    {
        $mapCard = static fn($card) => [...$card['card']->output(), 'amount' => $card['amount']];

        return [
            'id' => $this->id,
            'name' => $this->name,
            'modifier' => $this->modifier?->identifier,
            'shrine' => $this->shrine?->modifier,
            'specialization' => $this->specialization?->identifier,
            'base' => array_map($mapCard, $this->cards[0]),
            'tier_1' => array_map($mapCard, [...$this->cards[1], ...$this->cards[2]]),
            'tier_2' => $this->tier > 0 ? array_map($mapCard, [...$this->cards[3], ...$this->cards[4]]) : null,
            'tier_3' => $this->tier > 1 ? array_map($mapCard, [...$this->cards[5], ...$this->cards[6]]) : null,
            'final' => $this->tier > 1 ? array_map($mapCard, $this->cards[7]) : null,
        ];
    }
}
