<?php

namespace App\Model;

class Card
{
    public string $icon;

    public string $text;

    public array $data = [];

    public ?Modifier $modifier = null;

    public int $value = 0;

    public function output(): array
    {
        return [
            'icon' => $this->icon,
            'text' => $this->text,
            'value' => $this->value,
        ];
    }
}
