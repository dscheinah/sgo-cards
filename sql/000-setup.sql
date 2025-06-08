CREATE TABLE `users`
(
    `id`   VARCHAR(32),
    `name` VARCHAR(512),
    PRIMARY KEY (`id`)
);

CREATE TABLE `leagues`
(
    `id`       INT UNSIGNED AUTO_INCREMENT,
    `modifier` VARCHAR(128) NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE `players`
(
    `id`        INT UNSIGNED AUTO_INCREMENT,
    `user_id`   VARCHAR(32),
    `league_id` INT UNSIGNED,
    `try`       INT UNSIGNED NOT NULL DEFAULT 0,
    `x`         INT UNSIGNED NOT NULL DEFAULT 0,
    `y`         INT UNSIGNED NOT NULL DEFAULT 0,
    `modifier`  VARCHAR(128),

    INDEX (`user_id`, `league_id`),
    INDEX (`league_id`, `x`, `y`),

    FOREIGN KEY (`user_id`)
        REFERENCES `users` (`id`)
        ON DELETE CASCADE,
    FOREIGN KEY (`league_id`)
        REFERENCES `leagues` (`id`)
        ON DELETE CASCADE,

    PRIMARY KEY (`id`)
);

CREATE TABLE `player_cards`
(
    `id`        INT UNSIGNED AUTO_INCREMENT,
    `player_id` INT UNSIGNED,
    `health`    FLOAT,
    `damage`    FLOAT,
    `defense`   FLOAT,
    `magic`     FLOAT,
    `speed`     FLOAT,
    `modifier`  VARCHAR(128) NULL,

    FOREIGN KEY (`player_id`)
        REFERENCES `players` (`id`)
        ON DELETE CASCADE,

    PRIMARY KEY (`id`)
);

CREATE TABLE snapshots
(
    `id`        INT UNSIGNED AUTO_INCREMENT,
    `league_id` INT UNSIGNED,
    `x`         INT UNSIGNED NOT NULL DEFAULT 0,
    `y`         INT UNSIGNED NOT NULL DEFAULT 0,
    `modifier`  VARCHAR(128),
    `data`      JSON,
    `modifiers` JSON,
    `user_id`   VARCHAR(32) NULL,
    `try`       INT UNSIGNED NOT NULL DEFAULT 0,

    INDEX (`league_id`, `x`, `y`),

    FOREIGN KEY (`league_id`)
        REFERENCES `leagues` (`id`)
        ON DELETE CASCADE,

    FOREIGN KEY (`user_id`)
        REFERENCES `users` (`id`)
        ON DELETE SET NULL,

    PRIMARY KEY (`id`)
);
