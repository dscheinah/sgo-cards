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
        unset($data['world'], $data['player']);
        return $data;
    }

    public function update(array $data, string $modifier): array
    {
        $card = $this->get($modifier);
        foreach ($card as $key => $value) {
            if (is_numeric($value)) {
                if ($card['multiplicative'] ?? false) {
                    $data[$key] *= $value;
                } else {
                    $data[$key] += $value;
                }
            }
        }
        return $data;
    }

    public function pickPlayer(): string
    {
        return array_rand(array_filter($this->modifiers, static fn ($modifier) => $modifier['player'] ?? false));
    }

    public function pickWorld(): string
    {
        return array_rand(array_filter($this->modifiers, static fn ($modifier) => $modifier['world'] ?? false));
    }

    public function calculateModifierChanges(array $modifiers): float
    {
        $modifiers = array_filter($modifiers, static fn ($mod) => $mod && ($mod['mods'] ?? false));

        $total = 1;
        foreach ($modifiers as $modifier) {
            $total *= $modifier['mods'];
        }
        return $total;
    }

    public function applyFlat(array $data, array $modifiers, float $change): array
    {
        $modifiers = array_filter($modifiers, static fn ($mod) => $mod && !($mod['multiplicative'] ?? false));

        foreach ($modifiers as $modifier) {
            foreach ($modifier as $key => $value) {
                if ($key !== 'mods' && is_numeric($value)) {
                    $data[$key] += $value * $change;
                }
            }
        }
        return $data;
    }

    public function applyMultiplicative(array $data, array $modifiers, float $change): array
    {
        $modifiers = array_filter($modifiers, static fn ($mod) => $mod && ($mod['multiplicative'] ?? false));

        foreach ($modifiers as $modifier) {
            foreach ($modifier as $key => $value) {
                if (is_numeric($value)) {
                    $data[$key] *= $value * $change;
                }
            }
        }
        return $data;
    }
}
