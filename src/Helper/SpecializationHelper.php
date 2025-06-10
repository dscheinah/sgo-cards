<?php

namespace App\Helper;

use App\Model\Player;
use App\Model\Specialization;

class SpecializationHelper
{
    public function __construct(
        private readonly ModifierHelper $modifierHelper,
        private readonly array $specializations,
    ) {
    }

    public function get(?string $identifier): ?Specialization
    {
        if (!$identifier || !isset($this->specializations[$identifier])) {
            return null;
        }
        $input = $this->specializations[$identifier];

        $specialization = new Specialization();
        $specialization->identifier = $identifier;
        $specialization->name = $input['name'];
        $specialization->description = $input['description'];
        foreach ($input['modifiers'] ?? [] as $modifier) {
            $specialization->modifiers[] = $this->modifierHelper->get($modifier);
        }
        $specialization->handler = $input['handler'] ?? null;

        return $specialization;
    }

    /**
     * @return array<Specialization>
     */
    public function list(array $data, int $maxY): array
    {
        $specializations = [];
        foreach ($this->specializations as $identifier => $input) {
            if (isset($input['y']) && $maxY < $input['y']) {
                continue;
            }
            if (isset($input['data'])) {
                $hit = array_filter(
                    $input['data'],
                    static fn ($value, $key) => $data[$key] >= $value,
                    ARRAY_FILTER_USE_BOTH
                );
                if (count($hit) !== count($input['data'])) {
                    continue;
                }
            }
            $specializations[] = $this->get($identifier);
        }
        return $specializations;
    }

    public function random(array $data, int $y): ?Specialization
    {
        $specializations = $this->list($data, $y);
        if (!$specializations) {
            return null;
        }
        $specializations[] = null;
        mt_srand();
        return $specializations[array_rand($specializations)];
    }
}
