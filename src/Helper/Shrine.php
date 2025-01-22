<?php

namespace App\Helper;

use App\Helper\Shrine\ShrineInterface;
use App\Storage\ShrineStorage;

class Shrine
{
    private ?array $atPosition = null;

    private array $inRange = [];

    public function __construct(
        private readonly ShrineStorage $shrineStorage,
        private readonly array $shrines,
        private readonly int $max,
    ) {
    }

    public function initialize(int $leagueId, array $player): void
    {
        $x = $player['x'];
        $y = $player['y'];

        $this->inRange = iterator_to_array($this->shrineStorage->fetchActiveForPosition($leagueId, $x, $y));
        if ($this->inRange) {
            return;
        }

        $limit = $this->max / 10;
        if (($x < $limit || $x > $this->max - $limit) && ($y < $limit || $y > $this->max - $limit)) {
            return;
        }

        mt_srand($leagueId + ($x * $this->max) + $y);
        $this->atPosition = $this->shrineStorage->fetchOrCreate($leagueId, $x, $y, array_rand($this->shrines));
    }

    public function isActive(): bool
    {
        if ($this->inRange || !$this->atPosition) {
            return true;
        }
        return $this->atPosition['active'];
    }

    public function activate(): void
    {
        if (!$this->atPosition) {
            return;
        }
        $this->shrineStorage->activate($this->atPosition['league_id'], $this->atPosition['x'], $this->atPosition['y']);
        $this->atPosition['active'] = true;
    }

    public function getCard(): ?array
    {
        if (!$this->atPosition) {
            return null;
        }
        $shrine = $this->shrines[$this->atPosition['modifier']] ?? null;
        if (!$shrine) {
            return null;
        }
        return [
            'icon' => $shrine['icon'],
            'text' => $shrine['text'],
            'shrine' => true,
        ];
    }

    /**
     * @return ShrineInterface[]
     */
    public function getInRange(): array
    {
        $inRange = [];
        foreach ([$this->atPosition, ...$this->inRange] as $current) {
            if (!$current || !$current['active']) {
                continue;
            }
            $shrine = $this->shrines[$current['modifier']] ?? null;
            if ($shrine) {
                $inRange[] = new $shrine['handler'];
            }
        }
        return $inRange;
    }

    public function getDataInRange(): array
    {
        $inRange = [];
        foreach ([$this->atPosition, ...$this->inRange] as $current) {
            if (!$current || !$current['active']) {
                continue;
            }
            $shrine = $this->shrines[$current['modifier']] ?? null;
            if ($shrine) {
                $inRange[] = [
                    'icon' => $shrine['icon'],
                    'description' => $shrine['description'],
                ];
            }
        }
        return $inRange;
    }

    public function getStatistics(int $leagueId): array
    {
        $positions = [];
        $data = [];
        foreach ($this->shrineStorage->fetchAllActive($leagueId) as $loaded) {
            $shrine = $this->shrines[$loaded['modifier']] ?? null;
            if ($shrine) {
                $positions[$loaded['x']][$loaded['y']] = $shrine['color'];
                $data[$loaded['modifier']] = [
                    'icon' => $shrine['icon'],
                    'color' => $shrine['color'],
                    'description' => $shrine['description'],
                ];
            }
        }
        return [
            'positions' => $positions,
            'data' => array_values($data),
        ];
    }
}
