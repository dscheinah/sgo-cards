<?php

namespace App\Provider;

use App\Helper\TreasureHelper;
use App\Model\Battlefield;
use App\Model\League;
use App\Model\Player;
use App\Model\Treasure;
use App\Storage\TreasureStorage;

class TreasureProvider
{
    public function __construct(
        private readonly TreasureStorage $treasureStorage,
        private readonly TreasureHelper $treasureHelper,
    ) {
    }

    /**
     * @param League $league
     * @param Player $player
     *
     * @return array<Treasure>
     */
    public function create(League $league, Player $player): array
    {
        return array_filter(
            array_map(
                fn (array $input) => $this->treasureHelper->get($input),
                iterator_to_array($this->treasureStorage->fetchAllForUserAndLeague($player->user_id, $league->id))
            )
        );
    }

    public function endOfTurn(Battlefield $battlefield): void
    {
        foreach ($battlefield->treasures as $treasure) {
            $treasure->endOfTurn($battlefield);
            $this->treasureStorage->update($treasure);
        }
        if ($battlefield->player->try <= count($battlefield->treasures)) {
            return;
        }
        if ((mt_rand() % 1000) > ($battlefield->battle->winner ? 9 : 0)) {
            return;
        }
        $exclude = [];
        $counter = 0;
        foreach ($battlefield->treasures as $treasure) {
            if ($counter >= 9 || !$treasure->multiple) {
                $exclude[] = $treasure->treasure;
            } else {
                $counter++;
            }
        }
        $treasure = $this->treasureHelper->random($exclude);
        if ($treasure) {
            $treasure->initialize();
            $this->treasureStorage->insertOne($battlefield->player->user_id, $battlefield->league->id, $treasure);
        }
    }
}
