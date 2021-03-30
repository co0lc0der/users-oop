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
    `name`   STRING  UNIQUE,
    `pass`   STRING  NOT NULL,
    `status` STRING,
--    `hash`   STRING,
		`group_id` INTEGER REFERENCES `groups` (`id`) 
);

DROP TABLE IF EXISTS `user_sessions`;
CREATE TABLE `user_sessions` (
    `id`      INTEGER       PRIMARY KEY AUTOINCREMENT,
    `user_id` INTEGER       REFERENCES `users` (`id`) ON DELETE CASCADE,
    `hash`    STRING
);

INSERT INTO `users` VALUES
(1, 'asd@asd.ru', 'Admin', '$2y$10$C4bhdsDnPGYMWSJ.Ad/w5uisIqji/t6dbYZRyPwI1FDDGBFursOwe', 'a short text', 2),
(2, 'qwe@qwe.ru', 'User', '$2y$10$P/93uSuvfs9QAlKLreNIuOHd/9RqtliuLN06qAMrU9ncvvH0enLka', 'users text', 1);

--(1, 'asd@asd.ru', 'Admin', '$2y$10$C4bhdsDnPGYMWSJ.Ad/w5uisIqji/t6dbYZRyPwI1FDDGBFursOwe', 'a short text', NULL, 2),
--(2, 'qwe@qwe.ru', 'User', '$2y$10$P/93uSuvfs9QAlKLreNIuOHd/9RqtliuLN06qAMrU9ncvvH0enLka', 'users text', NULL, 1);

COMMIT TRANSACTION;
