#!/usr/bin/env php
<?php

use App\Container\Provider;
use App\Repository\TournamentRepository;
use Sx\Container\Injector;

$baseDirectory = dirname(__DIR__);
require $baseDirectory . '/vendor/autoload.php';

$options = [];
foreach (glob($baseDirectory . '/config/*.php') as $file) {
    $options[] = include $file;
}

$injector = new Injector(array_merge([], ...$options));
$injector->setup(new Provider());

$repository = $injector->get(TournamentRepository::class);
assert($repository instanceof TournamentRepository);
$repository->run();
