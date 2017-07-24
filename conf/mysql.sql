CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `data` text NOT NULL,
  `updated_on` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
);

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nid` varchar(32) NOT NULL DEFAULT '',
  `username` varchar(65) NOT NULL DEFAULT '',
  `password` varchar(65) NOT NULL DEFAULT '',
  `confirm_hash` varchar(65) NOT NULL DEFAULT '',
  `winuser` varchar(15) NOT NULL DEFAULT '',
  `is_confirmed` int(11),
  `level` enum('user','admin') NOT NULL DEFAULT 'user',
  `email` varchar(65) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
);

CREATE TABLE `url_cache` (
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `dt_refreshed` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dt_expires` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `url` (`url`)
);

CREATE TABLE authors (
  id int NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  biography mediumtext,

  PRIMARY KEY (id)
);

CREATE TABLE books (
  id int(11) NOT NULL AUTO_INCREMENT,
  author_id int NOT NULL,
  title varchar(100) NOT NULL,
  isbn varchar(13),

  PRIMARY KEY (id),
  FOREIGN KEY (author_id) REFERENCES authors (id)
);
