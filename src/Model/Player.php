<?php

namespace App\Model;

class Player
{
    public ?int $id = null;

    public ?string $user_id = null;

    public ?string $name = null;

    public int $try = 0;

    public int $x = 0;

    public int $y = 0;

    public Modifier $modifier;

    /** @var array<string, Modifier>  */
    public array $modifiers = [];

    public ?Specialization $specialization = null;

    /** @var array<Specialization> */
    public array $specializations = [];

    public array $data;

    public int $curse = 0;

    public function calculation(League $league, ?Player $enemy = null): array
    {
        $modifiers = array_filter([
            $league->modifier,
            ...array_filter($enemy?->mods() ?: [], static fn (Modifier $modifier) => $modifier->enemy),
            ...array_filter($this->mods(), static fn (Modifier $modifier) => $modifier->self),
        ]);

        $change = 1;
        foreach (array_filter($modifiers, static fn (Modifier $modifier) => $modifier->modifiers) as $modifier) {
            $change *= $modifier->data['mods'];
        }

        $modifiers = array_filter($modifiers, static fn (Modifier $modifier) => !$modifier->modifiers);

        $data = $this->data;
        foreach (array_filter($modifiers, static fn(Modifier $modifier) => !$modifier->multiplicative) as $modifier) {
            $data = $modifier->handler::apply($data, $modifier, $change);
        }
        foreach (array_filter($modifiers, static fn (Modifier $modifier) => $modifier->multiplicative) as $modifier) {
            $data = $modifier->handler::multiply($data, $modifier, $change);
        }
        return array_map(static fn ($value) => max((int) round($value), 0), $data);
    }

    /**
     * @return array<Modifier>
     */
    public function mods(): array
    {
        return [$this->modifier, ...($this->specialization?->modifiers ?: []), ...$this->modifiers];
    }

    public function withModifier(Modifier $modifier): Player
    {
        $player = clone $this;
        if (isset($player->modifiers[$modifier->identifier])) {
            $modifier = $modifier->withModifier($player->modifiers[$modifier->identifier]);
        }
        $player->modifiers[$modifier->identifier] = $modifier;
        return $player;
    }

    public function withCard(Card $card): Player
    {
        $player = $card->modifier ? $this->withModifier($card->modifier) : clone $this;
        foreach ($card->data as $key => $value) {
            $player->data[$key] += $value;
        }
        if (in_array(Card::CURSE, $card->tags, true)) {
            $player->curse++;
        }
        return $player;
    }

    public function output(League $league, ?Player $enemy = null): array
    {
        return [
            'name' => $this->name,
            'try' => $this->try,
            'x' => $this->x,
            'y' => $this->y,
            'modifier' => $this->modifier->output(),
            'modifiers' => array_map(
                static fn (Modifier $modifier) => $modifier->output(),
                array_values($this->modifiers)
            ),
            'specialization' => $this->specialization?->output(),
            'specializations' => array_map(
                static fn (Specialization $specialization) => $specialization->output(),
                $this->specializations
            ),
            'data' => array_map(static fn ($value) => (int) $value, $this->data),
            'calculation' => $this->calculation($league, $enemy),
        ];
    }
}
