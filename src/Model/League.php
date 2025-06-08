<?php

namespace App\Model;

class League
{
    public int $id;

    public ?Modifier $modifier = null;

    /** @var array<Area> */
    public array $areas = [];
}
