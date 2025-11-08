<?php

namespace App\Helper;

use App\Model\Area;
use App\Model\League;

class AreaHelper
{
    public function __construct(
        private readonly array $areas,
        private readonly int $max,
    ) {
    }

    /**
     * @param League $league
     *
     * @return array<Area>
     */
    public function getForLeague(League $league): array
    {
        mt_srand($league->id);

        $pool = $this->areas;
        shuffle($pool);

        $areas = [];

        $h = mt_rand(0, 25);
        while ($pool && $h < $this->max) {
            $y = mt_rand($h + 5, $h + 15);
            $h = mt_rand($y + 10, $y + 20);

            $input = array_pop($pool);

            $area = new Area();
            $area->icon = $input['icon'];
            $area->name = $input['name'];
            $area->description = $input['description'];
            $area->handler = $input['handler'];
            $area->y = $y;
            $area->h = $h;

            $areas[] = $area;
        }

        return $areas;
    }
}
