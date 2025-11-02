CREATE TABLE `heroes`
(
    `id`             INT UNSIGNED AUTO_INCREMENT,
    `user_id`        VARCHAR(32),
    `name`           VARCHAR(512),
    `modifier`       VARCHAR(128) NULL,
    `shrine`         VARCHAR(128) NULL,
    `specialization` VARCHAR(128) NULL,
    `active`         BOOL DEFAULT FALSE,

    FOREIGN KEY (`user_id`)
        REFERENCES `users` (`id`)
        ON DELETE CASCADE,

    PRIMARY KEY (`id`)
);

CREATE TABLE `hero_cards`
(
    `hero_id`    INT UNSIGNED,
    `identifier` VARCHAR(128),
    `amount`     INT UNSIGNED,

    FOREIGN KEY (`hero_id`)
        REFERENCES `heroes` (`id`)
        ON DELETE CASCADE,

    PRIMARY KEY (`hero_id`, `identifier`)
);

CREATE TABLE `tournaments`
(
    `id`       INT UNSIGNED AUTO_INCREMENT,
    `modifier` VARCHAR(128),
    `area`     VARCHAR(128),
    `date`     DATETIME,

    PRIMARY KEY (`id`)
);

CREATE TABLE `results`
(
    `tournament_id` INT UNSIGNED,
    `tier`          INT UNSIGNED,
    `user_id`       VARCHAR(32),
    `hero_id`       INT UNSIGNED,
    `win`           INT UNSIGNED,
    `loose`         INT UNSIGNED,
    `rank_before`   INT UNSIGNED,
    `rank_after`    INT UNSIGNED,

    FOREIGN KEY (`tournament_id`)
        REFERENCES `tournaments` (`id`)
        ON DELETE CASCADE,
    FOREIGN KEY (`user_id`)
        REFERENCES `users` (`id`)
        ON DELETE CASCADE,
    FOREIGN KEY (`hero_id`)
        REFERENCES `heroes` (`id`)
        ON DELETE CASCADE,

    PRIMARY KEY (`tournament_id`, `tier`, `user_id`)
);

CREATE TABLE `rankings`
(
    `tier`    INT UNSIGNED,
    `rank`    INT UNSIGNED,
    `user_id` VARCHAR(32),
    `hero_id` INT UNSIGNED,

    FOREIGN KEY (`user_id`)
        REFERENCES `users` (`id`)
        ON DELETE CASCADE,
    FOREIGN KEY (`hero_id`)
        REFERENCES `heroes` (`id`)
        ON DELETE CASCADE,

    PRIMARY KEY (`tier`, `rank`)
);
