-- table creation
CREATE TABLE IF NOT EXISTS users(
id INT AUTO_INCREMENT PRIMARY KEY,
name varchar(32),
password varchar(6),
email TEXT
);

CREATE TABLE IF NOT EXISTS bookmaster(
id INT AUTO_INCREMENT PRIMARY KEY,
title varchar(32),
author varchar(32),
publisher varchar(32)
);

CREATE TABLE IF NOT EXISTS history(
book_id INT,
user_id INT
);

-- initial insertion
-- ミスがありそう
INSERT INTO users VALUES (null, 'tester1', 'pass', 'test@test.com');

INSERT INTO bookmaster (title, author, publisher) VALUES ('銀翼のイカロス', '池井戸潤', '文藝春秋');

INSERT INTO bookmaster (title, author, publisher) VALUES ('吾輩は猫である', '夏目漱石', '岩波書店');

INSERT INTO history(book_id, user_id)
VALUES(1, 1);

INSERT INTO history(book_id, user_id)
VALUES(2, 1);

