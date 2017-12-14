CREATE TABLE sessions (
  id varchar(255) NOT NULL,
  data text NOT NULL,
  updated_on varchar(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (id)
);

CREATE TABLE users (
  id int NOT NULL IDENTITY,
  nid varchar(32) NOT NULL DEFAULT '',
  username varchar(65) NOT NULL DEFAULT '' UNIQUE,
  password varchar(65) NOT NULL DEFAULT '',
  confirm_hash varchar(65) NOT NULL DEFAULT '',
  winuser varchar(15) NOT NULL DEFAULT '',
  is_confirmed varchar(255),
  level varchar(15) NOT NULL DEFAULT 'user',
  email varchar(65) NOT NULL DEFAULT '',
  PRIMARY KEY (id),
);

CREATE TABLE url_cache (
  url varchar(255)  NOT NULL DEFAULT '' UNIQUE,
  dt_refreshed datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  dt_expires datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  data text NOT NULL,
);

CREATE TABLE authors (
  id int NOT NULL IDENTITY,
  name varchar(100) NOT NULL,
  biography varchar(max),

  PRIMARY KEY (id)
) ;

CREATE TABLE books (
  id int NOT NULL IDENTITY,
  author_id int NOT NULL,
  title varchar(100) NOT NULL,
  isbn varchar(13),

  PRIMARY KEY (id),
  FOREIGN KEY (author_id) REFERENCES authors (id)
) ;