<?php

namespace App\Model;

use App\Helper\Shrine\ShrineInterface;

class Shrine
{
    public int $x;

    public int $y;

    public string $modifier;

    public string $text;

    public string $icon;

    public string $color;

    public string $description;

    /** @var class-string<ShrineInterface> */
    public string $handler;

    public function output(): array
    {
        return [
            'text' => $this->text,
            'icon' => $this->icon,
            'color' => $this->color,
            'description' => $this->description,
        ];
    }
}
