CREATE TABLE addresses (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	address_street VARCHAR(255) NOT NULL,
	address_street_number VARCHAR(255) NOT NULL,
	address_phone_number VARCHAR(255) NOT NULL,
	address_fax_number VARCHAR(255) NOT NULL,
	address_email VARCHAR(255) NOT NULL,
	place_id VARCHAR(255) NOT NULL
);
