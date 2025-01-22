<?php

namespace App\Helper;

class Battle
{
    public function __construct(
        private readonly Modifier $modifier,
        private readonly Player $player,
        private readonly int $power,
    ) {
    }

    public function isWinner(array $player, array $enemy, ?array $modifier): bool
    {
        $playerModified = $this->player->applyModifiers($player, $enemy, $modifier);
        $enemyModified = $this->player->applyModifiers($enemy, $player, $modifier);
        return $this->battle($playerModified, $enemyModified);
    }

    public function getCardValues(array $player, array $cards, int $leagueId, ?array $modifier): array
    {
        $enemies = [];
        for ($i = 0; $i < $this->power; $i++) {
            $randomBot = $this->player->createRandomBot($player['x'], $player['y'], $leagueId);
            $randomBot['modifier'] = $this->modifier->get($randomBot['modifier']);
            $enemies[] = $randomBot;
        }

        foreach ($cards as $index => $card) {
            $cards[$index]['value'] = 0;
            $nextPlayer = $this->player->applyCard($player, $card);
            foreach ($enemies as $enemy) {
                if ($this->isWinner($nextPlayer, $enemy, $modifier)) {
                    $cards[$index]['value']++;
                }
            }
        }

        return $cards;
    }

    private function battle(array $player, array $enemy): bool
    {
        $playerStats = $this->player->stats($player, $enemy);
        $enemyStats = $this->player->stats($enemy, $player);

        if ($playerStats['speed'] > 0) {
            $enemyStats['health'] -= (int) ($player['data']['damage'] ?? 0);
        }
        if ($enemyStats['speed'] > 0) {
            $playerStats['health'] -= (int) ($enemy['data']['damage'] ?? 0);
        }

        while ($playerStats['health'] > 0 && $enemyStats['health'] > 0) {
            $playerStats['health'] -= $enemyStats['damage'] + $enemyStats['magic'];
            $enemyStats['health'] -= $playerStats['damage'] + $playerStats['magic'];
        }

        return $playerStats['health'] > $enemyStats['health'];
    }
}
