<?php

namespace App\Model;

class League
{
    public ?int $id = null;

    public ?Modifier $modifier = null;

    /** @var array<Area> */
    public array $areas = [];
}
