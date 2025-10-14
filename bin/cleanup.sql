DELETE
FROM `player_cards`
WHERE `player_id` IN (SELECT `id` FROM `players` WHERE `league_id` < (SELECT MAX(`id`) FROM `leagues`) AND `y` < 100);

UPDATE `snapshots`
SET `data`      = NULL,
    `modifiers` = NULL
WHERE `league_id` < (SELECT MAX(`id`) FROM `leagues`);
