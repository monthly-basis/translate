CREATE TABLE `translate` (
    `translate_id` int(10) unsigned not null auto_increment,
    `en` varchar(255) not null,
    `es` varchar(255) default null,
    `fr` varchar(255) default null,
    PRIMARY KEY (`translate_id`)
) CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
