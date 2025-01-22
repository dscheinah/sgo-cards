CREATE TABLE `shrines`
(
    `league_id` INT UNSIGNED,
    `x`         INT UNSIGNED,
    `y`         INT UNSIGNED,
    `modifier`  VARCHAR(128),
    `active`    BOOL DEFAULT FALSE,

    FOREIGN KEY (`league_id`)
        REFERENCES `leagues` (`id`)
        ON DELETE CASCADE,

    PRIMARY KEY (`league_id`, `x`, `y`)
);
