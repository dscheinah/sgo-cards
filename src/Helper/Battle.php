<?php

namespace App\Helper;

class Battle
{
    public function __construct(
        private readonly Modifier $modifier,
        private readonly Player $player,
        private readonly Shrine $shrine,
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
        $shrines = $this->shrine->getInRange();

        $player['data']['magic_offense'] = $player['data']['magic'];
        $player['data']['magic_defense'] = $player['data']['magic'];
        $enemy['data']['magic_offense'] = $enemy['data']['magic'];
        $enemy['data']['magic_defense'] = $enemy['data']['magic'];
        foreach ($shrines as $shrine) {
            $player = $shrine->player($player);
            $enemy = $shrine->player($enemy);
        }

        $playerStats = $this->player->stats($player, $enemy);
        $enemyStats = $this->player->stats($enemy, $player);

        foreach ($shrines as $shrine) {
            $playerStats = $shrine->stats($playerStats);
            $enemyStats = $shrine->stats($enemyStats);
        }

        if ($playerStats['speed'] > 0) {
            $speedDamage = $playerStats['damage'];
            foreach ($shrines as $shrine) {
                $speedDamage = $shrine->speed($playerStats, $speedDamage);
            }
            $enemyStats['health'] -= $speedDamage;
        }
        if ($enemyStats['speed'] > 0) {
            $speedDamage = $enemyStats['damage'];
            foreach ($shrines as $shrine) {
                $speedDamage = $shrine->speed($enemyStats, $speedDamage);
            }
            $playerStats['health'] -= $speedDamage;
        }

        $round = 0;
        while ($playerStats['health'] > 0 && $enemyStats['health'] > 0) {
            foreach ($shrines as $shrine) {
                $playerStats = $shrine->battle($playerStats);
                $enemyStats = $shrine->battle($enemyStats);
            }
            $drain = 1.1 ** $round;
            $playerStats['health'] -= $enemyStats['damage'] + $enemyStats['magic'] + (int) $drain;
            $enemyStats['health'] -= $playerStats['damage'] + $playerStats['magic'] + (int) $drain;
            $round++;
        }

        return $playerStats['health'] > $enemyStats['health'];
    }
}
