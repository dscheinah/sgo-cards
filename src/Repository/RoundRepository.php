<?php

namespace App\Repository;

use App\Helper\Card;
use App\Helper\Modifier;
use App\Helper\Player;
use App\Storage\CardStorage;
use App\Storage\LeagueStorage;
use App\Storage\PlayerStorage;
use App\Storage\SnapshotStorage;

class RoundRepository
{
    public function __construct(
        private readonly CardStorage $cardStorage,
        private readonly LeagueStorage $leagueStorage,
        private readonly PlayerStorage $playerStorage,
        private readonly SnapshotStorage $snapshotStorage,
        private readonly Card $card,
        private readonly Modifier $modifier,
        private readonly Player $player,
        private readonly int $max,
    ) {
    }

    public function load(string $userId): ?array
    {
        $currentLeague = $this->leagueStorage->fetchLatest();
        $leagueId = $currentLeague['id'];

        $currentPlayer = $this->playerStorage->fetchLatestForUserAndLeague($userId, $leagueId);
        if (!$currentPlayer) {
            $currentPlayer = [
                'user_id' => $userId,
                'league_id' => $leagueId,
                'x' => 0,
                'y' => 0,
                'modifier' => $this->modifier->pickPlayer(),
            ];
            $currentPlayer['id'] = $this->playerStorage->insertOne($currentPlayer);
        }

        return [
            'league' => [
                'id' => $leagueId,
                'modifier' => $this->modifier->get($currentLeague['modifier']),
            ],
            'player' => $this->player->get($currentPlayer),
            'try' => $this->playerStorage->fetchCountForUserAndLeague($userId, $leagueId),
            'cards' => $this->card->draw($currentPlayer, $leagueId),
        ];
    }

    public function run(string $userId, int $card): ?array
    {
        $currentLeague = $this->leagueStorage->fetchLatest();
        $leagueId = $currentLeague['id'];

        $currentPlayer = $this->playerStorage->fetchLatestForUserAndLeague($userId, $leagueId);
        if (!$currentPlayer) {
            return null;
        }

        $cards = $this->card->draw($currentPlayer, $leagueId);
        if (!isset($cards[$card])) {
            return null;
        }
        $this->cardStorage->insertForPlayer($currentPlayer['id'], $cards[$card]);

        $player = $this->player->get($currentPlayer);
        $enemy = $this->snapshotStorage->fetchRandomForLeagueAtPosition($leagueId, $player['x'], $player['y']);
        if (!$enemy) {
            $enemy = $this->player->createRandomBot($player['x'], $player['y'], $leagueId);
        }
        $enemy['modifier'] = $this->modifier->get($enemy['modifier']);

        $this->snapshotStorage->insertForLeagueFromPlayer($leagueId, $currentPlayer, $player['data']);

        if ($this->battle($player, $enemy, $this->modifier->get($currentLeague['modifier']))) {
            $this->playerStorage->updateY($player['id'], ++$player['y']);
            if (!$currentLeague['modifier'] && $player['y'] >= $this->max * 0.75) {
                $this->leagueStorage->updateModifier($leagueId, $this->modifier->pickWorld());
            }
            if ($player['y'] >= $this->max) {
                $this->leagueStorage->insertOne();
                return ['league' => true];
            }
            return ['winner' => true];
        }

        $this->playerStorage->updateX($player['id'], ++$player['x']);
        if ($player['x'] >= $this->max) {
            $this->playerStorage->insertOne([
                'user_id' => $userId,
                'league_id' => $leagueId,
                'modifier' => $this->modifier->pickPlayer(),
            ]);
            return ['finished' => true];
        }
        return ['winner' => false];
    }

    private function battle(array $player, array $enemy, ?array $modifier): bool
    {
        $playerModified = $this->player->applyModifiers($player, $enemy, $modifier);
        $enemyModified = $this->player->applyModifiers($enemy, $player, $modifier);

        $playerStats = $this->player->stats($playerModified, $enemyModified);
        $enemyStats = $this->player->stats($enemyModified, $playerModified);

        if ($playerStats['speed'] > 0) {
            $enemyStats['health'] -= $playerModified['data']['damage'] ?? 0;
        }
        if ($enemyStats['speed'] > 0) {
            $playerStats['health'] -= $enemyModified['data']['damage'] ?? 0;
        }

        while ($playerStats['health'] > 0 && $enemyStats['health'] > 0) {
            $playerStats['health'] -= $enemyStats['damage'] + $enemyStats['magic'];
            $enemyStats['health'] -= $playerStats['damage'] + $playerStats['magic'];
        }

        return $playerStats['health'] > 0;
    }
}
