# library_app
 
 A simple demonstration of PHP and PostgreSQL to build a framework for storing library books and reservation information.
 
 # Built Using
 
 1. PHP
 2. PostgreSQL
 3. Bootstrap
 4. JQuery

# Licensing
Distributed under MIT license. 

# DB Setup
CREATE TABLE authors (
author_id SERIAL PRIMARY KEY,
	last_name VARCHAR(100) NOT NULL,
	first_name VARCHAR(100) NOT NULL,
	dob DATE
);

CREATE TABLE books (
book_id SERIAL PRIMARY KEY,
	title VARCHAR(200) NOT NULL,
	author_id INT,
	date_published DATE,
	CONSTRAINT fk_author FOREIGN KEY(author_id)
		REFERENCES authors(author_id)
);

CREATE TABLE users (
user_id SERIAL PRIMARY KEY,
	last_name VARCHAR(200) NOT NULL,
	first_name VARCHAR(200) NOT NULL,
	phone_number VARCHAR(100) NOT NULL UNIQUE
	);

CREATE TABLE reservations (
reserve_id SERIAL PRIMARY KEY,
	reserved_at TIMESTAMP NOT NULL DEFAULT NOW(),
	due_date DATE NOT NULL DEFAULT NOW() + INTERVAL '7' DAY,
	book_id INT NOT NULL,
	user_id INT,
	CONSTRAINT fk_book_id FOREIGN KEY(book_id)
	REFERENCES books(book_id)
	CONSTRAINT fk_user_id FOREIGN KEY(user_id) 
	REFERENCES users(user_id)
);

CREATE TABLE descriptions (
	description_id SERIAL PRIMARY KEY,
	text TEXT,
	book_id INT NOT NULL,
	CONSTRAINT fk_book_id FOREIGN KEY(book_id)
	REFERENCES books(book_id)
);
