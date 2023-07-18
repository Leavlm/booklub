CREATE DATABASE booklub;

CREATE TABLE author(
    id_author INT(5) NOT NULL AUTO_INCREMENT,
    author_name VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_author)
)

CREATE TABLE editor(
    id_editor INT(5) NOT NULL AUTO_INCREMENT,
    editor_name VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_editor)
)

CREATE TABLE cover(
    id_cover INT(5) NOT NULL AUTO_INCREMENT,
    cover_book VARCHAR(100) NOT NULL,
    PRIMARY KEY (id_cover)
)

CREATE TABLE book(
    id_book INT(10) NOT NULL AUTO_INCREMENT,
    title_book VARCHAR(100) NOT NULL,
    release_date DATE NOT NULL,
    nb_pages INT NOT NULL,
    id_autor INT,
    id_editor INT,
    id_cover INT,
    PRIMARY KEY (id_book),
    FOREIGN KEY(id_cover) REFERENCES author(id_author),
    FOREIGN KEY(id_editor) REFERENCES editor(id_editor),
    FOREIGN KEY(id_cover) REFERENCES cover(id_cover)
)

CREATE TABLE caracteristics(
    id_caracteristics INT NOT NULL AUTO_INCREMENT,
    topic VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_caracteristics)
	)

CREATE TABLE belongs(
    id_caracteristics INT,
    id_book INT,
    PRIMARY KEY (id_caracteristics, id_book),
    FOREIGN KEY (id_caracteristics) REFERENCES caracteristics(id_caracteristics),
    FOREIGN KEY (id_book) REFERENCES book(id_book)
	)

    CREATE TABLE genre(
id_genre INT(5) NOT NULL AUTO_INCREMENT,
name_genre VARCHAR(50) NOT NULL,
PRIMARY KEY(id_genre))

CREATE TABLE own(
id_genre INT,
id_book INT,
PRIMARY KEY(id_genre, id_book),
FOREIGN KEY(id_genre) REFERENCES genre(id_genre),
    FOREIGN KEY (id_book) REFERENCES book(id_book))

CREATE TABLE users(
	id_users INT(10) NOT NULL AUTO_INCREMENT,
	username VARCHAR(50) UNIQUE NOT NULL,
	firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
	email VARCHAR(50) NOT NULL,
	password VARCHAR(50) NOT NULL,
    date_creation_account DATETIME NOT NULL,
    PRIMARY KEY (id_users)
	)

CREATE TABLE CONSULT(
	id_book INT,
	id_users INT,
	PRIMARY KEY(id_book, id_users),
    FOREIGN KEY (id_book) REFERENCES book(id_book),
	FOREIGN KEY (id_users) REFERENCES users(id_users))

CREATE TABLE ranking(
	id_book INT,
	id_users INT,
    note INT(1) NOT NULL,
    comment_ranking VARCHAR(150) NOT NULL,
    date_ranking DATE NOT NULL,
	PRIMARY KEY(id_book, id_users),
    FOREIGN KEY (id_book) REFERENCES book(id_book),
	FOREIGN KEY (id_users) REFERENCES users(id_users))

CREATE TABLE favorise(
    id_book INT,
    id_users INT,
    PRIMARY KEY (id_book, id_users),
    FOREIGN KEY (id_book) REFERENCES book(id_book),
    FOREIGN KEY (id_users) REFERENCES users(id_users)
)


CREATE TABLE ranks(
    id_users_buyer INT NOT NULL,
    id_users_seller INT NOT NULL,
    date_note DATE NOT NULL,
    user_note INT(1) NOT NULL,
    user_comment VARCHAR(120) NOT NULL,
    PRIMARY KEY(id_users_seller, id_users_buyer),
    FOREIGN KEY (id_users_seller) REFERENCES users(id_users),
    FOREIGN KEY (id_users_buyer) REFERENCES users(id_users)
	)

CREATE TABLE orders(
	id_orders INT NOT NULL AUTO_INCREMENT,
	quantity INT NOT NULL,
	total_amount INT NOT NULL,
	date_purchase DATETIME NOT NULL,
	id_users INT,
	PRIMARY KEY(id_orders),
    FOREIGN KEY (id_users) REFERENCES users(id_users))

CREATE TABLE copy(
	id_copy INT NOT NULL AUTO_INCREMENT,
	state VARCHAR(10) NOT NULL,
	price INT NOT NULL,
	adding_date DATETIME NOT NULL,
	id_book INT,
	id_users INT,
	id_orders INT,
	PRIMARY KEY(id_copy),
    FOREIGN KEY (id_book) REFERENCES book(id_book),
    FOREIGN KEY (id_users) REFERENCES users(id_users),
    FOREIGN KEY (id_orders) REFERENCES orders(id_orders))

CREATE TABLE payment(
	id_payment INT NOT NULL AUTO_INCREMENT,
	card_nb INT NOT NULL,
	id_users INT,
	PRIMARY KEY (id_payment),
	FOREIGN KEY (id_users) REFERENCES users(id_users))

CREATE TABLE address(
	id_address INT NOT NULL AUTO_INCREMENT,
	zip_code INT NOT NULL,
	address VARCHAR(100) NOT NULL,
	city VARCHAR(100) NOT NULL,
	id_users INT,
	PRIMARY KEY (id_address),
	FOREIGN KEY (id_users) REFERENCES users(id_users))