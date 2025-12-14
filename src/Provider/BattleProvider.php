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

        $this->snapshotStorage->insertForLeagueFromPlayer($battlefield->league, $battlefield->player);

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

        $playerCalculation = $battlefield->player->calculation($battlefield->league->modifier, $battlefield->enemy);
        $enemyCalculation = $battlefield->enemy->calculation($battlefield->league->modifier, $battlefield->player);

        $player = $this->prepare($playerCalculation, $enemyCalculation);
        $enemy = $this->prepare($enemyCalculation, $playerCalculation);
        $battle->log($player, $enemy, $this->stats($player, $enemy), $this->stats($enemy, $player));

        foreach ($battlefield->treasures as $treasure) {
            $playerCalculation = $treasure->calculation($playerCalculation);
        }
        if ($battlefield->area?->handler) {
            $playerCalculation = $battlefield->area->handler::calculation($playerCalculation);
            $enemyCalculation = $battlefield->area->handler::calculation($enemyCalculation);
        }

        $player = $this->prepare($playerCalculation, $enemyCalculation);
        $enemy = $this->prepare($enemyCalculation, $playerCalculation);
        $battle->log($player, $enemy, $this->stats($player, $enemy), $this->stats($enemy, $player));

        foreach ($battlefield->treasures as $treasure) {
            $player = $treasure->player($player);
        }
        foreach ($battlefield->shrines as $shrine) {
            $player = $shrine->handler::player($player);
            $enemy = $shrine->handler::player($enemy);
        }
        if ($battlefield->area?->handler) {
            $player = $battlefield->area->handler::player($player);
            $enemy = $battlefield->area->handler::player($enemy);
        }

        $battle->log($player, $enemy, $this->stats($player, $enemy), $this->stats($enemy, $player));

        $player['health'] -= $enemy['speed_damage'];
        $enemy['health'] -= $player['speed_damage'];

        $battle->log($player, $enemy, $this->stats($player, $enemy), $this->stats($enemy, $player));

        while ($player['health'] > 0 && $enemy['health'] > 0) {
            foreach ($battlefield->treasures as $treasure) {
                $player = $treasure->battlePlayer($player, $enemy);
                $enemy = $treasure->battleEnemy($enemy, $player);
            }
            foreach ($battlefield->shrines as $shrine) {
                $player = $shrine->handler::battle($player, $enemy);
                $enemy = $shrine->handler::battle($enemy, $player);
            }
            if ($battlefield->area?->handler) {
                $player = $battlefield->area->handler::battle($player, $enemy, $battle->duration);
                $enemy = $battlefield->area->handler::battle($enemy, $player, $battle->duration);
            }
            if ($battlefield->player->specialization?->handler) {
                $player = $battlefield->player->specialization->handler::battle($player, $battle->duration);
            }
            if ($battlefield->enemy->specialization?->handler) {
                $enemy = $battlefield->enemy->specialization->handler::battle($enemy, $battle->duration);
            }

            $playerStats = $this->stats($player, $enemy);
            $enemyStats = $this->stats($enemy, $player);

            foreach ($battlefield->shrines as $shrine) {
                $playerStats = $shrine->handler::stats($playerStats);
                $enemyStats = $shrine->handler::stats($enemyStats);
            }

            $battle->log($player, $enemy, $playerStats, $enemyStats);

            $drain = (int) (1.1 ** $battle->duration);
            $player['health'] -= $enemyStats['damage'] + $enemyStats['magic'] + $drain;
            $enemy['health'] -= $playerStats['damage'] + $playerStats['magic'] + $drain;
            $battle->duration++;

            $battle->log($player, $enemy, $playerStats, $enemyStats);
        }

        $battle->winner = $player['health'] >= $enemy['health'];
        return $battle;
    }

    private function prepare(array $player, array $enemy): array
    {
        $player['health'] *= 10;

        $player['magic_offense'] = $player['magic'];
        $player['magic_defense'] = (int) ($player['magic'] / 3 * 2) + (int) ($player['defense'] / 3);

        $player['speed'] = max(0, $player['speed'] - $enemy['speed']);
        $player['speed_damage'] = $player['speed'] > 0 ? $player['damage'] : 0;

        return $player;
    }

    private function stats(array $player, array $enemy): array {
        $crit = (rand() % 100 < (int) $player['speed'] % 100 ? 1.2 : 1) + (int) ($player['speed'] / 100) * .2;
        return  [
            'crit' => $crit,
            'damage' => max($player['damage'] * $crit - $enemy['defense'], 0),
            'magic' => max($player['magic_offense'] - $enemy['magic_defense'], 0),
        ];
    }
}
