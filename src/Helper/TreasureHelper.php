<?php

namespace App\Helper;

use App\Model\Treasure;

class TreasureHelper
{
    public function __construct(
        private readonly array $treasures,
    ) {
    }

    public function get(array $input): ?Treasure
    {
        $identifier = $input['treasure'] ?? null;
        if (!$identifier) {
            return null;
        }
        $data = $this->treasures[$identifier] ?? null;
        if (!$data) {
            return null;
        }
        $treasure = new Treasure();
        $treasure->id = $input['id'] ?? null;
        $treasure->treasure = $identifier;
        $treasure->handler = $data['handler'];
        $treasure->type = $data['type'] ?? null;
        $treasure->icon = $data['icon'];
        $treasure->name = $data['name'];
        $treasure->descriptions = $data['descriptions'];
        $treasure->active = $input['active'] ?? false;
        $treasure->trigger_min = $data['trigger_min'] ?? 0;
        $treasure->trigger_max = $data['trigger_max'] ?? 0;
        $treasure->trigger = $input['trigger'] ?? 0;
        $treasure->experience = $input['experience'] ?? 0;
        $treasure->charges_base = $data['charges_base'] ?? 0;
        $treasure->charges = $input['charges'] ?? 0;
        $treasure->multiple = $data['multiple'] ?? false;
        $treasure->power = $treasure->level() + 1;
        return $treasure;
    }

    public function random(): ?Treasure
    {
        return $this->get(['treasure' => array_rand($this->treasures)]);
    }

    public function count(): int
    {
        return count($this->treasures);
    }
}
