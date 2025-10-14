CREATE TABLE `pool_cards`
(
    `id`         INT UNSIGNED AUTO_INCREMENT,
    `user_id`    VARCHAR(32),
    `identifier` VARCHAR(128),
    `type`       VARCHAR(128),
    `tier`       INT UNSIGNED,
    `count`      INT UNSIGNED DEFAULT 1,

    UNIQUE INDEX (`user_id`, `identifier`),
    INDEX (`user_id`, `type`, `count`),

    FOREIGN KEY (`user_id`)
        REFERENCES `users` (`id`)
        ON DELETE CASCADE,

    PRIMARY KEY (`id`)
);

CREATE TABLE `pool_shrines`
(
    `id`         INT UNSIGNED AUTO_INCREMENT,
    `user_id`    VARCHAR(32),
    `identifier` VARCHAR(128),

    UNIQUE INDEX (`user_id`, `identifier`),

    FOREIGN KEY (`user_id`)
        REFERENCES `users` (`id`)
        ON DELETE CASCADE,

    PRIMARY KEY (`id`)
);

CREATE TABLE `pool_specializations`
(
    `id`         INT UNSIGNED AUTO_INCREMENT,
    `user_id`    VARCHAR(32),
    `identifier` VARCHAR(128),

    UNIQUE INDEX (`user_id`, `identifier`),

    FOREIGN KEY (`user_id`)
        REFERENCES `users` (`id`)
        ON DELETE CASCADE,

    PRIMARY KEY (`id`)
);
