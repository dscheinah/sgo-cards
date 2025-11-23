<?php

namespace App\Storage;

use Generator;
use Sx\Data\Storage;

class ResultStorage extends Storage
{
    public function fetchLatest(string $userId): Generator
    {
        $statement = 'SELECT * FROM `results` 
            WHERE `user_id` = ? AND `tournament_id` = (SELECT MAX(`tournament_id`) FROM `results`) 
            ORDER BY `tier`';
        return $this->fetch($statement, [$userId]);
    }
}
