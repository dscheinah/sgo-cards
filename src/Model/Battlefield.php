<?php

namespace App\Model;

class Battlefield
{
    public League $league;

    public Player $player;

    /** @var array<Card> */
    public array $cards = [];

    public ?Card $card = null;

    /** @var array<Shrine> */
    public array $shrines = [];

    public ?Shrine $shrine = null;

    public ?Player $enemy = null;

    public ?Battle $battle = null;
}
