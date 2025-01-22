<?php

namespace App\Storage;

use Generator;
use Sx\Data\Storage;

class ShrineStorage extends Storage
{
    public function fetchOrCreate(int $leagueId, int $x, int $y, string $modifier): array
    {
        $this->execute(
            'INSERT IGNORE INTO `shrines` (`league_id`, `x`, `y`, `modifier`) VALUES (?, ?, ?, ?)',
            [$leagueId, $x, $y, $modifier],
        );
        return $this->fetch(
            'SELECT * FROM `shrines` WHERE `league_id`= ? AND `x` = ? AND `y` = ?',
            [$leagueId, $x, $y],
        )->current();
    }

    public function activate(int $leagueId, int $x, int $y): void
    {
        $this->execute(
            'UPDATE `shrines` SET `active` = TRUE WHERE `league_id`= ? AND `x` = ? AND `y` = ?',
            [$leagueId, $x, $y],
        );
    }

    public function fetchAllActive(int $leagueId): Generator
    {
        return $this->fetch('SELECT * FROM `shrines` WHERE `league_id`= ? AND `active` = TRUE', [$leagueId]);
    }

    public function fetchActiveForPosition(int $leagueId, int $x, int $y): Generator
    {
        return $this->fetch(
            'SELECT * FROM `shrines` WHERE `league_id`= ? AND `active` = TRUE
                AND ((`x` = ? AND `y` <> ?) OR (`x` <> ? AND `y` = ?))',
            [$leagueId, $x, $y, $x, $y]
        );
    }
}
