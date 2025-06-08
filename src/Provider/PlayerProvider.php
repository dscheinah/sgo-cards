<?php

namespace App\Provider;

use App\Helper\CardHelper;
use App\Helper\ModifierHelper;
use App\Helper\SpecializationHelper;
use App\Model\League;
use App\Model\Player;
use App\Storage\CardStorage;
use App\Storage\PlayerStorage;
use App\Storage\SnapshotStorage;
use App\Storage\UserStorage;

class PlayerProvider
{
    public function __construct(
        private readonly CardStorage $cardStorage,
        private readonly PlayerStorage $playerStorage,
        private readonly SnapshotStorage $snapshotStorage,
        private readonly UserStorage $userStorage,
        private readonly CardHelper $cardHelper,
        private readonly ModifierHelper $modifierHelper,
        private readonly SpecializationHelper $specializationHelper,
        private readonly int $max,
        private readonly int $health,
        private readonly int $damage,
    ) {
    }

    public function create(string $userId, League $league): Player
    {
        $input = $this->playerStorage->fetchLatestForUserAndLeague($userId, $league->id);
        if (!$input || $input['x'] >= $this->max) {
            $input = [
                'user_id' => $userId,
                'league_id' => $league->id,
                'try' => $this->playerStorage->fetchCountForUserAndLeague($userId, $league->id) + 1,
                'x' => 0,
                'y' => 0,
                'modifier' => $this->modifierHelper->pickPlayer(),
            ];
            $input['id'] = $this->playerStorage->insertOne($input);
        }
        $player = $this->createPlayerFromCards($input);
        $player->specialization = $this->specializationHelper->get($input['specialization'] ?? null);
        $player->specializations = $this->specializationHelper->list(
            $player->data,
            $this->playerStorage->fetchMaxYForUserAndLeague($userId, $league->id),
        );
        return $player;
    }

    public function createEnemy(League $league, Player $player): Player
    {
        $input = $this->snapshotStorage->fetchRandomForLeagueAtPosition($league->id, $player->x, $player->y);
        if ($input) {
            $enemy = $this->createPlayer($input);
            foreach ($input['modifiers'] as $identifier => $data) {
                $modifier = $this->modifierHelper->get($identifier);
                if (!$modifier) {
                    continue;
                }
                $modifier->data = $data['data'];
                $modifier->count = $data['count'];
                $enemy->modifiers[$identifier] = $modifier;
            }
            return $enemy;
        }

        $enemy = $this->createPlayer([
            'x' => $player->x,
            'y' => $player->y,
            'modifier' => $this->modifierHelper->pickPlayer(),
            'data' => [
                'health' => $this->health,
                'damage' => $this->damage,
                'defense' => 0,
                'magic' => 0,
                'speed' => 0,
            ],
        ]);
        $level = $player->x + $player->y + 1;
        for ($i = 0; $i < $level; $i++) {
            $enemy = $enemy->withCard($this->cardHelper->pick($league, $enemy));
        }
        return $enemy;
    }

    public function createWinner(League $league): ?Player
    {
        $input = $this->playerStorage->fetchOneForLeagueAtY($league->id, $this->max);
        if (!$input) {
            return null;
        }
        return $this->createPlayerFromCards($input);
    }

    private function createPlayer(array $input): Player
    {
        $player = new Player();
        $player->id = $input['id'] ?? null;
        $player->user_id = $input['user_id'] ?? null;
        $player->name = $this->userStorage->fetchOne($player->user_id)['name'] ?? '';
        $player->try = $input['try'] ?? 0;
        $player->x = $input['x'];
        $player->y = $input['y'];
        $player->modifier = $this->modifierHelper->get($input['modifier']);
        $player->data = array_map(static fn ($value) => (float) $value, $input['data']);
        return $player;
    }

    private function createPlayerFromCards(array $input): Player
    {
        $input['data'] = $this->cardStorage->fetchStatsForPlayer($input['id']);
        $input['data']['health'] += $this->health;
        $input['data']['damage'] += $this->damage;

        $player = $this->createPlayer($input);

        foreach ($this->cardStorage->fetchModifiersForPlayer($input['id']) as $card) {
            $modifier = $this->modifierHelper->get($card['modifier']);
            if (!$modifier) {
                continue;
            }
            $player = $player->withModifier($modifier);
        }

        return $player;
    }
}
