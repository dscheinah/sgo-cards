<?php

namespace App\Model;

use DateTimeImmutable;

class Tournament
{
    public int $id;

    public ?Modifier $modifier = null;

    public ?Area $area = null;

    public DateTimeImmutable $date;

    public function output(): array
    {
        return [
            'modifier' => $this->modifier?->output(),
            'area' => $this->area?->output(),
            'hours' => (int) max(($this->date->getTimestamp() - time()) / 60 / 60, 0),
        ];
    }
}
