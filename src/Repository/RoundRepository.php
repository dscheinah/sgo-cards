<?php

namespace App\Repository;

use App\Helper\Battle;
use App\Helper\Card;
use App\Helper\Modifier;
use App\Helper\Player;
use App\Helper\Shrine;
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
        private readonly Battle $battle,
        private readonly Card $card,
        private readonly Modifier $modifier,
        private readonly Player $player,
        private readonly Shrine $shrine,
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
        $this->shrine->initialize($leagueId, $currentPlayer);

        $leagueModifier = $this->modifier->get($currentLeague['modifier']);
        $player = $this->player->get($currentPlayer);
        $cards = $this->card->draw($currentPlayer, $leagueId);

        $player['data']['modifiers'] = array_values($player['data']['modifiers']);

        return [
            'league' => [
                'id' => $leagueId,
                'modifier' => $leagueModifier,
            ],
            'player' => $player,
            'calculation' => $this->player->applyModifiers($player, null, $leagueModifier)['data'],
            'try' => $this->playerStorage->fetchCountForUserAndLeague($userId, $leagueId),
            'cards' => $this->battle->getCardValues($player, $cards, $leagueId, $leagueModifier),
            'shrines' => $this->shrine->getDataInRange(),
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
        $this->shrine->initialize($leagueId, $currentPlayer);

        if ($card === 542123) {
            $this->shrine->activate();
        } else {
            $cards = $this->card->draw($currentPlayer, $leagueId);
            if (!isset($cards[$card])) {
                return null;
            }
            $this->cardStorage->insertForPlayer($currentPlayer['id'], $cards[$card]);
        }

        $leagueModifier = $this->modifier->get($currentLeague['modifier']);

        $player = $this->player->get($currentPlayer);
        $enemy = $this->snapshotStorage->fetchRandomForLeagueAtPosition($leagueId, $player['x'], $player['y']);
        if (!$enemy) {
            $enemy = $this->player->createRandomBot($player['x'], $player['y'], $leagueId, $leagueModifier);
        }
        $enemy['modifier'] = $this->modifier->get($enemy['modifier']);

        $this->snapshotStorage->insertForLeagueFromPlayer($leagueId, $currentPlayer, $player['data']);

        $enemyCalculation = $this->player->applyModifiers($enemy, null, $leagueModifier)['data'];
        unset($enemyCalculation['modifiers']);

        if ($this->battle->isWinner($player, $enemy, $leagueModifier)) {
            $this->playerStorage->updateY($player['id'], ++$player['y']);
            if (!$currentLeague['modifier'] && $player['y'] >= $this->max * 0.75) {
                $this->leagueStorage->updateModifier($leagueId, $this->modifier->pickWorld());
            }
            if ($player['y'] >= $this->max) {
                $this->leagueStorage->insertOne();
                return ['league' => true, 'enemy' => $enemyCalculation];
            }
            return ['winner' => true, 'enemy' => $enemyCalculation];
        }

        $this->playerStorage->updateX($player['id'], ++$player['x']);
        if ($player['x'] >= $this->max) {
            $this->playerStorage->insertOne([
                'user_id' => $userId,
                'league_id' => $leagueId,
                'modifier' => $this->modifier->pickPlayer(),
            ]);
            return ['finished' => true, 'enemy' => $enemyCalculation];
        }
        return ['winner' => false, 'enemy' => $enemyCalculation];
    }
}
