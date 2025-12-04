<?php

namespace App\Provider;

use App\Helper\CardHelper;
use App\Model\Battlefield;
use App\Storage\PoolStorage;

class BattlefieldBuilder
{
    public function __construct(
        private readonly BattleProvider $battleProvider,
        private readonly LeagueProvider $leagueProvider,
        private readonly PlayerProvider $playerProvider,
        private readonly ShrineProvider $shrineProvider,
        private readonly TreasureProvider $treasureProvider,
        private readonly CardHelper $cardHelper,
        private readonly PoolStorage $poolStorage,
    ) {
    }

    public function create(string $userId): Battlefield
    {
        $league = $this->leagueProvider->createLatest();
        $player = $this->playerProvider->create($userId, $league);
        $treasures = $this->treasureProvider->create($league, $player);

        $this->shrineProvider->initialize($league, $player);

        $battlefield = new Battlefield();
        $battlefield->league = $league;
        $battlefield->player = $player;
        $battlefield->shrine = $this->shrineProvider->create();
        $battlefield->shrines = $this->shrineProvider->createInRange();

        foreach ($league->areas as $area) {
            if ($player->y >= $area->y && $player->y <= $area->h) {
                $battlefield->area = $area;
                break;
            }
        }

        $battlefield->treasures = $treasures;
        foreach ($treasures as $treasure) {
            $treasure->beginOfTurn($battlefield);
        }

        $battlefield->cards = $this->cardHelper->draw($league, $player, $treasures);

        return $battlefield;
    }

    public function fight(Battlefield $battlefield, int $card): void
    {
        $battlefield->enemy = $this->playerProvider->createEnemy($battlefield->league, $battlefield->player);

        if ($card === 542123) {
            if ($battlefield->shrine) {
                $battlefield->shrines[] = $battlefield->shrine;
                $this->poolStorage->insertShrine($battlefield->player->user_id, $battlefield->shrine);
            }
            $this->shrineProvider->activate();
        } else {
            $battlefield->card = $battlefield->cards[$card] ?? null;
            $this->poolStorage->insertCard($battlefield->player->user_id, $battlefield->card);
        }

        mt_srand();
        $battlefield->battle = $this->battleProvider->create($battlefield);
        $this->treasureProvider->endOfTurn($battlefield);
    }
}
