<?php

namespace App\Model;

class Battle
{
    public bool $winner = false;

    public bool $league = false;

    public bool $finished = false;

    public int $duration = 0;

    public array $log = [];

    public function log(array $player, array $enemy, array $playerStats, array $enemyStats): void
    {
        $this->log[] = [
            'player_health' => max(0, (int) round($player['health'] / 10)),
            'player_damage' => (int) $player['damage'],
            'player_magic' => (int) $player['magic_offense'],
            'player_real_damage' => (int) $playerStats['damage'],
            'player_real_magic' => (int) $playerStats['magic'],
            'enemy_health' => max(0, (int) round($enemy['health'] / 10)),
            'enemy_damage' => (int) $enemy['damage'],
            'enemy_magic' => (int) $enemy['magic_offense'],
            'enemy_real_damage' => (int) $enemyStats['damage'],
            'enemy_real_magic' => (int) $enemyStats['magic'],
        ];
    }
}
