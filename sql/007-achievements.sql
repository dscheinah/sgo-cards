ALTER TABLE `players`
    ADD `level` INT UNSIGNED NOT NULL DEFAULT 0,
    ADD INDEX (`user_id`, `level`),
    ADD INDEX (`user_id`, `modifier`);

ALTER TABLE `treasures`
    ADD INDEX (`user_id`, `treasure`);

ALTER TABLE `snapshots`
    ADD `total_base`        INT UNSIGNED NOT NULL DEFAULT 0,
    ADD `total_calculation` INT UNSIGNED NOT NULL DEFAULT 0,
    ADD `total_boost`       INT UNSIGNED NOT NULL DEFAULT 0,
    ADD INDEX (`user_id`, `total_base`),
    ADD INDEX (`user_id`, `total_calculation`),
    ADD INDEX (`user_id`, `total_boost`);
