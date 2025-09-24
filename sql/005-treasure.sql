CREATE TABLE `treasures`
(
    `id`         INT UNSIGNED AUTO_INCREMENT,
    `user_id`    VARCHAR(32),
    `league_id`  INT UNSIGNED,
    `treasure`   VARCHAR(128),
    `experience` INT UNSIGNED DEFAULT 0,
    `trigger`    INT UNSIGNED DEFAULT 0,
    `charges`    INT UNSIGNED DEFAULT 0,
    `active`     BOOL DEFAULT FALSE,

    INDEX (`user_id`, `league_id`),

    FOREIGN KEY (`user_id`)
        REFERENCES `users` (`id`)
        ON DELETE CASCADE,
    FOREIGN KEY (`league_id`)
        REFERENCES `leagues` (`id`)
        ON DELETE CASCADE,

    PRIMARY KEY (`id`)
);
