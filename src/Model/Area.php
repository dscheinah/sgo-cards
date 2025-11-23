<?php

namespace App\Model;

use App\Helper\Area\AreaInterface;

class Area
{
    public string $icon;

    public string $name;

    public string $description;

    public int $y = 0;

    public int $h = 0;

    /** @var class-string<AreaInterface> */
    public string $handler;

    public function output(): array
    {
        return [
            'icon' => $this->icon,
            'name' => $this->name,
            'description' => $this->description,
            'y' => $this->y,
            'h' => $this->h,
        ];
    }
}
