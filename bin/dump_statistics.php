#!/usr/bin/env php
<?php

use App\Container\Provider;
use App\Helper\Modifier;
use App\Helper\Player;
use App\Storage\SnapshotStorage;
use Sx\Container\Injector;

$leagueId = (int) ($argv[1] ?? 0);
if (!$leagueId) {
    fwrite(STDERR, "provide league id as first parameter\n");
    exit(1);
}

$baseDirectory = dirname(__DIR__);
require $baseDirectory . '/vendor/autoload.php';

$options = [];
foreach (glob($baseDirectory . '/config/*.php') as $file) {
    $options[] = include $file;
}

$injector = new Injector(array_merge([], ...$options));
$injector->setup(new Provider());

/* @var SnapshotStorage $snapshotStorage */
$snapshotStorage = $injector->get(SnapshotStorage::class);
/* @var Modifier $player */
$modifier = $injector->get(Modifier::class);
/* @var Player $player */
$player = $injector->get(Player::class);

echo "x;y;health;damage;defense;magic;speed\n";
foreach ($snapshotStorage->fetchAllForLeague($leagueId) as $snapshot) {
    $snapshot['modifier'] = $modifier->get($snapshot['modifier']);
    $data = array_map(
        static fn ($value) => (int) $value,
        $player->applyModifiers($snapshot, null, null)['data'],
    );
    echo implode(";", [
        $snapshot['x'], $snapshot['y'], $data['health'], $data['damage'], $data['defense'], $data['magic'], $data['speed']
    ]) . "\n";
}
