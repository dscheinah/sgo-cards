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

        $modifiers = [];
        foreach ($this->cardStorage->fetchModifiersForPlayer($player['id']) as $card) {
            $modifiers[$card['modifier']] = isset($modifiers[$card['modifier']])
                ? $this->modifier->update($modifiers[$card['modifier']], $card['modifier'])
                : $this->modifier->get($card['modifier']);
        }
        $data['modifiers'] = array_values($modifiers);

        return [
            'id' => $player['id'],
            'x' => $player['x'] ?? 0,
            'y' => $player['y'] ?? 0,
            'modifier' => $this->modifier->get($player['modifier']),
            'data' => $data,
        ];
    }

    public function createRandomBot(int $x, int $y, int $leagueId): array
    {
        $data = [
            'health' => $this->health,
            'damage' => $this->damage,
            'defense' => 0,
            'magic' => 0,
            'speed' => 0,
        ];
        $modifiers = [];

        for ($i = 0; $i < $x + $y + 1; $i++) {
            $card = $this->card->pick($y, $leagueId);
            foreach ($card['data'] ?? [] as $key => $value) {
                $data[$key] += $value;
            }
            if ($card['modifier'] ?? null) {
                $modifiers[$card['modifier']] = isset($modifiers[$card['modifier']])
                    ? $this->modifier->update($modifiers[$card['modifier']], $card['modifier'])
                    : $this->modifier->get($card['modifier']);
            }
        }
        $data['modifiers'] = array_values($modifiers);

        return [
            'x' => $x,
            'y' => $y,
            'modifier' => $this->modifier->pickPlayer(),
            'data' => $data,
        ];
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
        return [
            'health' => (int) $player['data']['health'],
            'damage' => max(
                max((int) $player['data']['damage'], 0) - max((int) $enemy['data']['defense'], 0),
                $this->damage
            ),
            'magic' => max(
                max((int) $player['data']['magic'], 0) - max((int) $enemy['data']['magic'], 0),
                0
            ),
            'speed' => max(
                max((int) $player['data']['speed'], 0) - max((int) $enemy['data']['speed'], 0),
                0
            ),
        ];
    }
}
