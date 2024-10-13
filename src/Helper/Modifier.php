<?php

namespace App\Helper;

class Modifier
{
    public function __construct(
        private readonly array $modifiers,
    ) {
    }

    public function get(?string $modifier): ?array
    {
        if (!$modifier) {
            return null;
        }
        $data = $this->modifiers[$modifier] ?? null;
        if (!$data) {
            return null;
        }
        $data['count'] = 1;
        return $data;
    }

    public function update(array $current, string $modifier): array
    {
        $card = $this->get($modifier);
        foreach ($card['data'] as $key => $value) {
            if ($card['multiplicative'] ?? false) {
                $current['data'][$key] *= $value;
            } else {
                $current['data'][$key] += $value;
            }
        }
        $current['count']++;
        return $current;
    }

    public function pickPlayer(): string
    {
        mt_srand();
        return array_rand(array_filter($this->modifiers, static fn ($modifier) => $modifier['player'] ?? false));
    }

    public function pickWorld(): string
    {
        mt_srand();
        return array_rand(array_filter($this->modifiers, static fn ($modifier) => $modifier['world'] ?? false));
    }

    public function calculateModifierChanges(array $modifiers): float
    {
        $modifiers = array_filter(
            $modifiers,
            static fn ($mod) => $mod && ($mod['modifiers'] ?? false)
        );

        $total = 1;
        foreach ($modifiers as $modifier) {
            $total *= $modifier['data']['mods'];
        }
        return $total;
    }

    public function applyFlat(array $data, array $modifiers, float $change): array
    {
        $modifiers = array_filter(
            $modifiers,
            static fn ($mod) => $mod && !($mod['multiplicative'] ?? false) && !($mod['modifiers'] ?? false)
        );

        foreach ($modifiers as $modifier) {
            foreach ($modifier['data'] as $key => $value) {
                $data[$key] += $value * $change;
            }
        }
        return $data;
    }

    public function applyMultiplicative(array $data, array $modifiers, float $change): array
    {
        $modifiers = array_filter(
            $modifiers,
            static fn ($mod) => $mod && ($mod['multiplicative'] ?? false) && !($mod['modifiers'] ?? false)
        );

        foreach ($modifiers as $modifier) {
            foreach ($modifier['data'] as $key => $value) {
                $data[$key] *= $value * $change;
            }
        }
        return $data;
    }
}
