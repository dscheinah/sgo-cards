<?php

namespace App\Model;

use App\Helper\Treasure\TreasureInterface;

class Treasure
{
    public ?int $id = null;

    public string $treasure;

    /** @var class-string<TreasureInterface> */
    public string $handler;

    public ?string $type = null;

    public string $icon;

    public string $name;

    /** @var array{identify: string, effect: string, level: string} */
    public array $descriptions = ['identify' => '', 'effect' => '', 'level' => ''];

    public bool $active = false;

    public int $trigger_min = 0;

    public int $trigger_max = 0;

    public int $trigger = 0;

    public int $experience = 0;

    public int $charges_base = 0;

    public int $charges = 0;

    public int $power = 0;

    public bool $multiple = false;

    public function initialize(): void
    {
        $this->trigger = mt_rand($this->trigger_min, $this->trigger_max);
    }

    public function beginOfTurn(Battlefield $battlefield): void
    {
        if (!$this->active || $this->trigger > 0) {
            return;
        }
        $this->handler::beginOfTurn($this, $battlefield);
    }

    public function needToRedraw(Card $card): bool
    {
        if (!$this->active || $this->trigger > 0) {
            return false;
        }
        return $this->handler::discard($this, $card);
    }

    public function calculation(array $calculation): array
    {
        if (!$this->active || $this->trigger > 0) {
            return $calculation;
        }
        return $this->handler::calculation($this, $calculation) ?: $calculation;
    }

    public function player(array $player): array
    {
        if (!$this->active || $this->trigger > 0) {
            return $player;
        }
        return $this->handler::player($this, $player) ?: $player;
    }

    public function battlePlayer(array $player, array $enemy): array
    {
        if (!$this->active || $this->trigger > 0) {
            return $player;
        }
        return $this->handler::battlePlayer($this, $player, $enemy) ?: $player;
    }

    public function battleEnemy(array $enemy, array $player): array
    {
        if (!$this->active || $this->trigger > 0) {
            return $enemy;
        }
        return $this->handler::battleEnemy($this, $enemy, $player) ?: $enemy;
    }

    public function endOfTurn(Battlefield $battlefield): void
    {
        if ($this->trigger === 0) {
            if ($this->handler::levels($this, $battlefield)) {
                $this->experience++;
            }
        } else {
            $this->handler::trigger($this, $battlefield);
            if ($this->trigger <= 0) {
                $this->trigger = 0;
                $this->charges = $this->charges_base;
            }
        }
    }

    public function level(): int
    {
        return (int) sqrt($this->experience);
    }

    public function output(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'icon' => $this->icon,
            'active' => $this->active,
            'descriptions' => $this->descriptions,
            'trigger' => $this->trigger,
            'level' => $this->level(),
            'charges' => $this->charges,
        ];
    }
}
