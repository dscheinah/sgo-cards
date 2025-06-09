<?php

namespace App\Provider;

use App\Helper\ModifierHelper;
use App\Model\Battle;
use App\Model\Battlefield;
use App\Storage\CardStorage;
use App\Storage\LeagueStorage;
use App\Storage\PlayerStorage;
use App\Storage\SnapshotStorage;

class BattleProvider
{
    public function __construct(
        private readonly CardStorage $cardStorage,
        private readonly LeagueStorage $leagueStorage,
        private readonly PlayerStorage $playerStorage,
        private readonly SnapshotStorage $snapshotStorage,
        private readonly ModifierHelper $modifierHelper,
        private readonly int $max,
    ) {
    }

    public function create(Battlefield $battlefield): Battle
    {
        $battle = $this->battle($battlefield);

        if ($battlefield->card) {
            $battlefield->player = $battlefield->player->withCard($battlefield->card);
            $this->cardStorage->insertForPlayer($battlefield->player->id, $battlefield->card);
        }

        $this->snapshotStorage->insertForLeagueFromPlayer($battlefield->league->id, $battlefield->player);

        if ($battle->winner) {
            $battlefield->player->y++;
            $this->playerStorage->updateY($battlefield->player->id, $battlefield->player->y);
        } else {
            $battlefield->player->x++;
            $this->playerStorage->updateX($battlefield->player->id, $battlefield->player->x);
        }

        if (!$battlefield->league->modifier && $battlefield->player->y >= $this->max * 0.75) {
            $this->leagueStorage->updateModifier($battlefield->league->id, $this->modifierHelper->pickWorld());
        }

        if ($battlefield->player->y >= $this->max) {
            $battle->league = true;
            $this->leagueStorage->insertOne();
        }
        if ($battlefield->player->x >= $this->max) {
            $battle->finished = true;
        }

        return $battle;
    }

    public function battle(Battlefield $battlefield): Battle
    {
        $battle = new Battle();

        $player = $battlefield->player->calculation($battlefield->league, $battlefield->enemy);
        $enemy = $battlefield->enemy->calculation($battlefield->league, $battlefield->player);

        $player['magic_offense'] = $player['magic'];
        $player['magic_defense'] = $player['magic'];
        $enemy['magic_offense'] = $enemy['magic'];
        $enemy['magic_defense'] = $enemy['magic'];
        foreach ($battlefield->shrines as $shrine) {
            $player = $shrine->handler::player($player);
            $enemy = $shrine->handler::player($enemy);
        }
        if ($battlefield->area) {
            $player = $battlefield->area->handler::player($player);
            $enemy = $battlefield->area->handler::player($enemy);
        }
        if ($battlefield->player->specialization?->handler) {
            $enemy = $battlefield->player->specialization?->handler::enemy($enemy);
        }

        $playerStats = $this->stats($player, $enemy);
        $enemyStats = $this->stats($enemy, $player);

        foreach ($battlefield->shrines as $shrine) {
            $playerStats = $shrine->handler::stats($playerStats);
            $enemyStats = $shrine->handler::stats($enemyStats);
        }

        if ($playerStats['speed'] > 0) {
            $speedDamage = $player['damage'];
            foreach ($battlefield->shrines as $shrine) {
                $speedDamage = $shrine->handler::speed($player, $speedDamage);
            }
            $enemyStats['health'] -= $speedDamage;
        }
        if ($enemyStats['speed'] > 0) {
            $speedDamage = $enemy['damage'];
            foreach ($battlefield->shrines as $shrine) {
                $speedDamage = $shrine->handler::speed($enemy, $speedDamage);
            }
            $playerStats['health'] -= $speedDamage;
        }

        while ($playerStats['health'] > 0 && $enemyStats['health'] > 0) {
            foreach ($battlefield->shrines as $shrine) {
                $playerStats = $shrine->handler::battle($playerStats, $battle->duration);
                $enemyStats = $shrine->handler::battle($enemyStats, $battle->duration);
            }
            if ($battlefield->area) {
                $playerStats = $battlefield->area->handler::battle($playerStats, $battle->duration);
                $enemyStats = $battlefield->area->handler::battle($enemyStats, $battle->duration);
            }
            if ($battlefield->player->specialization?->handler) {
                $playerStats = $battlefield->player->specialization?->handler::battle($playerStats, $battle->duration);
            }
            $drain = 1.1 ** $battle->duration;
            $playerStats['health'] -= $enemyStats['damage'] + $enemyStats['magic'] + (int) $drain;
            $enemyStats['health'] -= $playerStats['damage'] + $playerStats['magic'] + (int) $drain;
            $battle->duration++;
        }

        $battle->winner = $playerStats['health'] >= $enemyStats['health'];
        return $battle;
    }

    private function stats(array $player, array $enemy): array
    {
        return [
            'health' => $player['health'] * 10,
            'damage' => max(
                max($player['damage'], 0) - max($enemy['defense'], 0),
                1
            ),
            'defense' => $player['defense'],
            'magic' => max(
                max($player['magic_offense'], 0) - max($enemy['magic_defense'], 0),
                0
            ),
            'magic_defense' => $player['magic_defense'],
            'speed' => max(
                max($player['speed'], 0) - max($enemy['speed'], 0),
                0
            ),
        ];
    }
}
