CREATE TABLE `translate` (
    `translate_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `en` varchar(255) NOT NULL,
    `es` varchar(255) DEFAULT NULL,
    `fr` varchar(255) DEFAULT NULL,
    `st` varchar(255) DEFAULT NULL,
    `sw` varchar(255) DEFAULT NULL,
    `tl` varchar(255) DEFAULT NULL,
    PRIMARY KEY (`translate_id`),
    UNIQUE `en` (`en`)
) CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
