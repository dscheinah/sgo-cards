<?php

namespace App\Model;

class Card
{
    public const string HEALTH = 'health';
    public const string DAMAGE = 'damage';
    public const string DEFENSE = 'defense';
    public const string MAGIC = 'magic';
    public const string SPEED = 'speed';
    public const string BASE = 'base';
    public const string MODIFIER = 'modifier';
    public const string CURSE = 'curse';
    public const string CONVERSION = 'conversion';

    public string $identifier;

    public string $icon;

    public string $text;

    public array $data = [];

    public ?Modifier $modifier = null;

    public int $value = 0;

    public array $tags = [];

    public int $tier;

    public function output(): array
    {
        return [
            'icon' => $this->icon,
            'text' => $this->text,
            'value' => $this->value,
            'tags' => $this->tags,
        ];
    }
}
