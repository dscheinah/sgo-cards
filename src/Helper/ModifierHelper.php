<?php

namespace App\Helper;

use App\Helper\Modifier\DefaultModifier;
use App\Model\Modifier;

class ModifierHelper
{
    public function __construct(
        private readonly array $modifiers,
    ) {
    }

    public function get(?string $identifier): ?Modifier
    {
        if (!$identifier) {
            return null;
        }

        $input = $this->modifiers[$identifier] ?? null;
        if (!$input) {
            return null;
        }

        $modifier = new Modifier();
        $modifier->identifier = $identifier;
        $modifier->text = $input['text'];
        $modifier->data = $input['data'];
        $modifier->multiplicative = $input['multiplicative'] ?? false;
        $modifier->modifiers = $input['modifiers'] ?? false;
        $modifier->self = $input['self'] ?? false;
        $modifier->enemy = $input['enemy'] ?? false;
        $modifier->source = $input['source'] ?? null;
        $modifier->target = $input['target'] ?? null;
        $modifier->handler = $input['handler'] ?? DefaultModifier::class;

        return $modifier;
    }

    public function pickPlayer(): string
    {
        mt_srand();
        return array_rand(array_filter($this->modifiers, static fn ($modifier) => $modifier['player'] ?? false));
    }

    public function pickWorld(): string
    {
        mt_srand();
        return array_rand(array_filter($this->modifiers, static fn ($modifier) => $modifier['world'] ?? false));
    }

    public function countPlayer(): int
    {
        return count(array_filter($this->modifiers, static fn ($modifier) => $modifier['player'] ?? false));
    }
}
