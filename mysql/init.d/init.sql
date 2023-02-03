-- table creation
CREATE TABLE IF NOT EXISTS users(
id char(12) PRIMARY KEY,
name varchar(32),
password TEXT,
email TEXT,
verification_code char(6),
token char(6)
);

CREATE TABLE IF NOT EXISTS book_master(
isbn CHAR(13) PRIMARY KEY,
title varchar(32),
author varchar(32),
img_url TEXT
);

CREATE TABLE IF NOT EXISTS history(
isbn CHAR(13),
user_id char(12),
impression TEXT,
updated_date DATETIME
);

-- initial insertion
-- ミスがありそう
INSERT INTO users (id, name, password, email)VALUES ('A01234567890', 'tester1', 'pass', 'test@test.com');

INSERT INTO book_master (isbn, title, author, img_url) VALUES ('9784198942304', 'アキラとあきら', '池井戸潤', 'http://books.google.com/books/content?id=jo75swEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api' );

INSERT INTO book_master (isbn, title, author, img_url) VALUES ('9784167110116', '手紙', '東野圭吾', 'http://books.google.com/books/content?id=_XH4PgAACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api');

INSERT INTO book_master (isbn, title, author, img_url) VALUES ('9784041117170', '民王シベリアの陰謀', '池井戸潤', 'http://books.google.com/books/content?id=5IGKzgEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api');
INSERT INTO book_master (isbn, title, author, img_url) VALUES ('9784122064492',  '花咲舞が黙ってない', '池井戸潤', 'http://books.google.com/books/content?id=F-2CswEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api');
INSERT INTO book_master (isbn, title, author, img_url) VALUES ('9784087716191', '陸王', '池井戸潤', 'http://books.google.com/books/content?id=5y2DvgAACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api');

INSERT INTO history(isbn, user_id, impression, updated_date)
VALUES('9784198942304', 'A01234567890', 'that''s interesting', '2000-01-01 00:00:00');

INSERT INTO history(isbn, user_id, impression, updated_date)
VALUES('9784167110116', 'A01234567890', 'that''s fun', '2000-01-01 00:01:00');

