<?php

namespace App\Helper;

use App\Model\League;
use App\Model\Player;
use App\Model\Shrine;

class ShrineHelper
{
    public function __construct(
        private readonly array $shrines,
        private readonly int $max,
    ) {
    }

    public function get(array $input): ?Shrine
    {
        if (!isset($this->shrines[$input['modifier']])) {
            return null;
        }

        $shrine = new Shrine();
        $shrine->x = $input['x'];
        $shrine->y = $input['y'];
        $shrine->modifier = $input['modifier'];

        $data = $this->shrines[$input['modifier']];

        $shrine->text = $data['text'];
        $shrine->icon = $data['icon'];
        $shrine->color = $data['color'];
        $shrine->description = $data['description'];
        $shrine->handler = $data['handler'];
        $shrine->tags = $data['tags'];

        return $shrine;
    }

    public function random(League $league, Player $player): ?string
    {
        mt_srand($league->id + ($player->x * $this->max) + $player->y);
        if (mt_rand() % 5) {
            return null;
        }
        return array_rand($this->shrines);
    }
}
