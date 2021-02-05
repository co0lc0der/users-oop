BEGIN TRANSACTION;
DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
    `id`          INTEGER PRIMARY KEY AUTOINCREMENT,
    `name`        STRING  UNIQUE,
    `permissions` STRING
);

INSERT INTO `groups` VALUES
(1, 'Standart user', NULL), 
(2, 'Administrator', '{"admin": 1}');

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
		`id`     INTEGER PRIMARY KEY AUTOINCREMENT,
    `email`  STRING  UNIQUE  NOT NULL,
    `pass`   STRING  NOT NULL,
    `name`   STRING  UNIQUE,
    `status` STRING,
    `hash`   STRING,
		`group_id` INTEGER REFERENCES `groups` (`id`) 
);

INSERT INTO `users` VALUES
(1, 'asd@asd.ru', '$2y$10$C4bhdsDnPGYMWSJ.Ad/w5uisIqji/t6dbYZRyPwI1FDDGBFursOwe', 'Admin', 'a short text', NULL, 2),
(2, 'qwe@qwe.ru', '$2y$10$P/93uSuvfs9QAlKLreNIuOHd/9RqtliuLN06qAMrU9ncvvH0enLka', 'User', 'users text', NULL, 1);

COMMIT TRANSACTION;
