<?php

namespace App\Helper;

use App\Storage\CardStorage;

class Player
{
    public function __construct(
        private readonly CardStorage $cardStorage,
        private readonly Card $card,
        private readonly Modifier $modifier,
        private readonly int $health,
        private readonly int $damage,
    ) {
    }

    public function get(array $player): array
    {
        $data = $this->cardStorage->fetchStatsForPlayer($player['id']);
        $data['health'] += $this->health;
        $data['damage'] += $this->damage;
        $data['modifiers'] = [];

        foreach ($this->cardStorage->fetchModifiersForPlayer($player['id']) as $card) {
            $data['modifiers'][$card['modifier']] = isset($data['modifiers'][$card['modifier']])
                ? $this->modifier->update($data['modifiers'][$card['modifier']], $card['modifier'])
                : $this->modifier->get($card['modifier']);
        }

        return [
            'id' => $player['id'],
            'x' => $player['x'] ?? 0,
            'y' => $player['y'] ?? 0,
            'modifier' => $this->modifier->get($player['modifier']),
            'data' => $data,
        ];
    }

    public function applyCard(array $player, array $card): array
    {
        if ($card['shrine'] ?? false) {
            return $player;
        }
        foreach ($card['data'] ?? [] as $key => $value) {
            $player['data'][$key] += $value;
        }
        if ($card['modifier'] ?? null) {
            $player['data']['modifiers'][$card['modifier']] = isset($player['data']['modifiers'][$card['modifier']])
                ? $this->modifier->update($player['data']['modifiers'][$card['modifier']], $card['modifier'])
                : $this->modifier->get($card['modifier']);
        }
        return $player;
    }

    public function createRandomBot(int $x, int $y, int $leagueId, ?array $modifier): array
    {
        $bot = [
            'x' => $x,
            'y' => $y,
            'modifier' => $this->modifier->pickPlayer(),
            'data' => [
                'health' => $this->health,
                'damage' => $this->damage,
                'defense' => 0,
                'magic' => 0,
                'speed' => 0,
                'modifiers' => [],
            ],
        ];

        for ($i = 0; $i < $x + $y + 1; $i++) {
            $picks = [];
            for ($j = 0; $j < 3; $j++) {
                $pick = $this->applyCard($bot, $this->card->pick($y, $leagueId));
                $picks[$this->powerLevel($pick, $bot, $modifier)] = $pick;
            }
            ksort($picks);
            $bot = array_pop($picks);
        }

        return $bot;
    }

    private function powerLevel(array $player, array $base, ?array $modifier): int
    {
        $player['modifier'] = $this->modifier->get($player['modifier']);
        $player = $this->applyModifiers($player, $base, $modifier);

        $base['modifier'] = $this->modifier->get($base['modifier']);
        $base = $this->applyModifiers($base, $player, $modifier);

        $rel = static function ($a, $b) {
            if ($a > 0 && $b > 0) {
                return $a / $b;
            }
            if ($a > 0) {
                return 1;
            }
            return 0;
        };

        $lv = $rel($player['data']['health'],  $base['data']['health'])
            + $rel($player['data']['damage'],  $base['data']['damage'])
            + $rel($player['data']['defense'], $base['data']['defense'])
            + $rel($player['data']['magic'],   $base['data']['magic'])
            + $rel($player['data']['speed'],   $base['data']['speed']);

        return (int) ($lv * 100);
    }

    public function applyModifiers(array $player, ?array $enemy, ?array $modifier): array
    {
        $playerModifiers = array_filter($player['data']['modifiers'], static fn ($mod) => $mod['self'] ?? false);
        $enemyModifiers = $enemy
            ? array_filter($enemy['data']['modifiers'],  static fn ($mod) => $mod['enemy'] ?? false)
            : [];

        $modifiers = [$modifier, $player['modifier'], ...$player['data']['modifiers']];
        $change = $this->modifier->calculateModifierChanges($modifiers);

        $player['data'] = $this->modifier->applyFlat($player['data'], [$modifier, $player['modifier']], 1);
        $player['data'] = $this->modifier->applyFlat($player['data'], $enemyModifiers, $change);
        $player['data'] = $this->modifier->applyFlat($player['data'], $playerModifiers, $change);
        $player['data'] = $this->modifier->applyMultiplicative($player['data'], [$modifier, $player['modifier']], 1);
        $player['data'] = $this->modifier->applyMultiplicative($player['data'], $enemyModifiers, $change);
        $player['data'] = $this->modifier->applyMultiplicative($player['data'], $playerModifiers, $change);

        return $player;
    }

    public function stats(array $player, array $enemy): array
    {
        $playerData = $player['data'];
        $enemyData = $enemy['data'];
        return [
            'health' => (int) $playerData['health'],
            'damage' => max(
                max((int) $playerData['damage'], 0) - max((int) $enemyData['defense'], 0),
                $this->damage
            ),
            'magic' => max(
                max((int) $playerData['magic_offense'], 0) - max((int) $enemyData['magic_defense'], 0),
                0
            ),
            'speed' => max(
                max((int) $playerData['speed'], 0) - max((int) $enemyData['speed'], 0),
                0
            ),
        ];
    }
}
