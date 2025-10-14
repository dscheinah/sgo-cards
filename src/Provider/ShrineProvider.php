<?php

namespace App\Provider;

use App\Helper\ShrineHelper;
use App\Model\League;
use App\Model\Player;
use App\Model\Shrine;
use App\Storage\ShrineStorage;

class ShrineProvider
{
    private ?array $atPosition = null;

    private array $inRange = [];

    public function __construct(
        private readonly ShrineStorage $shrineStorage,
        private readonly ShrineHelper $shrineHelper,
        private readonly int $max,
    ) {
    }

    public function initialize(League $league, Player $player): void
    {
        $leagueId = $league->id;
        $x = $player->x;
        $y = $player->y;

        if ($leagueId % 2) {
            return;
        }

        $this->inRange = iterator_to_array($this->shrineStorage->fetchActiveForPosition($leagueId, $x, $y));
        if ($this->inRange) {
            return;
        }

        $limit = $this->max / 10;
        if ($x < $limit || $x > $this->max - $limit || $y < $limit || $y > $this->max - $limit) {
            return;
        }

        $modifier = $this->shrineHelper->random($league, $player);
        if (!$modifier) {
            return;
        }

        $this->atPosition = $this->shrineStorage->fetchOrCreate($leagueId, $x, $y, $modifier);
    }

    public function create(): ?Shrine
    {
        if (!$this->atPosition) {
            return null;
        }
        return $this->shrineHelper->get($this->atPosition);
    }

    /**
     * @return array<Shrine>
     */
    public function createInRange(): array
    {
        return array_filter(array_map(fn (array $input) => $this->shrineHelper->get($input), $this->inRange));
    }

    public function activate(): void
    {
        if (!$this->atPosition) {
            return;
        }
        $this->shrineStorage->activate($this->atPosition['league_id'], $this->atPosition['x'], $this->atPosition['y']);
    }
}
