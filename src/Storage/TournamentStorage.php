<?php

namespace App\Storage;

use Sx\Data\Storage;

class TournamentStorage extends Storage
{
    public function fetchLatest(): ?array
    {
        return $this->fetch('SELECT * FROM `tournaments` ORDER BY `id` DESC LIMIT 1')->current();
    }

    public function create(string $modifier, string $area, string $date): void
    {
        $this->execute(
            'INSERT INTO `tournaments` (`modifier`, `area`, `date`) VALUES (?, ?, ?)',
            [$modifier, $area, $date]
        );
    }
}
