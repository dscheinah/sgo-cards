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
    `health`    INT,
    `damage`    INT,
    `defense`   INT,
    `magic`     INT,
    `speed`     INT,
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

    INDEX (`league_id`, `x`, `y`),

    FOREIGN KEY (`league_id`)
        REFERENCES `leagues` (`id`)
        ON DELETE CASCADE,

    PRIMARY KEY (`id`)
);
