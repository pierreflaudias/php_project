-- MySQL
CREATE TABLE IF NOT EXISTS users
(
  id       INT          NOT NULL AUTO_INCREMENT,
  login    VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
);
CREATE TABLE IF NOT EXISTS statuses
(
  id      INT          NOT NULL AUTO_INCREMENT,
  content VARCHAR(255) NOT NULL,
  date    DATE,
  user_id INT,
  PRIMARY KEY (id),
  CONSTRAINT fk_UserId
  FOREIGN KEY (user_id) REFERENCES users (id)
);

INSERT INTO users (login, password) VALUES ("admin", "admin");
INSERT INTO statuses (content, date, user_id) VALUES ("First status", "2015-05-02", 1);
INSERT INTO statuses (content, date, user_id) VALUES ("Other status", "2017-06-04", 1);
INSERT INTO statuses (content, date, user_id) VALUES ("Anonymous status", "2016-07-09", NULL);

-- SQLite
-- CREATE TABLE IF NOT EXISTS users
-- (
-- 	id INTEGER PRIMARY KEY AUTOINCREMENT,
-- 	login VARCHAR(255) NOT NULL,
-- 	password VARCHAR(255) NOT NULL
-- );
-- CREATE TABLE IF NOT EXISTS statuses
-- (
-- 	id INTEGER PRIMARY KEY AUTOINCREMENT,
-- 	content VARCHAR(255) NOT NULL,
-- 	date DATE,
-- 	user_id INT,
-- 	CONSTRAINT fk_UserId
-- 	FOREIGN KEY (user_id) REFERENCES users(id)
-- );