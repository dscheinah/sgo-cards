<?php

namespace App\Model;

use App\Helper\Area\AreaInterface;

class Area
{
    public string $name;

    public int $y;

    public int $h;

    /** @var class-string<AreaInterface> */
    public string $handler;

    public function output(): array
    {
        return [
            'name' => $this->name,
            'y' => $this->y,
            'h' => $this->h,
        ];
    }
}
