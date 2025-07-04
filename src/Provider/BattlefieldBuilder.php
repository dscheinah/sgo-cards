<?php

namespace App\Provider;

use App\Helper\CardHelper;
use App\Model\Battlefield;
use RuntimeException;

class BattlefieldBuilder
{
    public function __construct(
        private readonly BattleProvider $battleProvider,
        private readonly LeagueProvider $leagueProvider,
        private readonly PlayerProvider $playerProvider,
        private readonly ShrineProvider $shrineProvider,
        private readonly CardHelper $cardHelper,
    ) {
    }

    public function create(string $userId): Battlefield
    {
        $league = $this->leagueProvider->createLatest();
        $player = $this->playerProvider->create($userId, $league);

        $this->shrineProvider->initialize($league, $player);

        $battlefield = new Battlefield();
        $battlefield->league = $league;
        $battlefield->player = $player;
        $battlefield->shrine = $this->shrineProvider->create();
        $battlefield->shrines = $this->shrineProvider->createInRange();
        $battlefield->cards = $this->cardHelper->draw($league, $player);

        foreach ($league->areas as $area) {
            if ($player->y >= $area->y && $player->y <= $area->h) {
                $battlefield->area = $area;
                break;
            }
        }

        return $battlefield;
    }

    public function createAndFight(string $userId, int $league, int $card): Battlefield
    {
        $battlefield = $this->create($userId);

        if ($battlefield->league->id !== $league) {
            throw new RuntimeException();
        }

        $battlefield->enemy = $this->playerProvider->createEnemy($battlefield->league, $battlefield->player);

        if ($card === 542123) {
            if ($battlefield->shrine) {
                $battlefield->shrines[] = $battlefield->shrine;
            }
            $this->shrineProvider->activate();
        } else {
            $battlefield->card = $battlefield->cards[$card] ?? null;
        }

        mt_srand();
        $battlefield->battle = $this->battleProvider->create($battlefield);

        return $battlefield;
    }
}
