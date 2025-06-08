<?php

namespace App\Model;

use App\Helper\Specialization\SpecializationInterface;

class Specialization
{
    public string $identifier;

    public string $name;

    /** @var array<Modifier> */
    public array $modifiers = [];

    /** @var class-string<SpecializationInterface>|null */
    public ?string $handler = null;

    public function output(): array
    {
        return [
            'identifier' => $this->identifier,
            'name' => $this->name,
        ];
    }
}
