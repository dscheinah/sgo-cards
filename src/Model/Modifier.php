<?php

namespace App\Model;

use App\Helper\Modifier\ModifierInterface;

class Modifier
{
    public string $identifier;

    public string $text;

    public array $data;

    public int $count = 1;

    public bool $multiplicative = false;

    public bool $modifiers = false;

    public bool $self = false;

    public bool $enemy = false;

    public ?string $source = null;

    public ?string $target = null;

    /** @var class-string<ModifierInterface> */
    public string $handler;

    public function withModifier(Modifier $update): Modifier
    {
        $modifier = clone $this;

        $modifier->count += $update->count;

        foreach ($update->data as $key => $value) {
            if ($update->multiplicative) {
                $modifier->data[$key] *= $value;
            } else {
                $modifier->data[$key] += $value;
            }
        }

        return $modifier;
    }

    public function output(): array
    {
        return [
            'identifier' => $this->identifier,
            'text' => $this->text,
            'value' => $this->enemy ? array_sum($this->data) : $this->count,
        ];
    }
}
