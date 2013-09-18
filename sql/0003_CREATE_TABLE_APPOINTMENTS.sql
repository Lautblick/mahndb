CREATE TABLE appointments (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	appointment_datetime DATETIME NOT NULL,
	appointment_description TEXT NOT NULL,
	appointment_location VARCHAR(255) NOT NULL,
	appointment_closed TINYINT(1) NOT NULL DEFAULT 0,
	case_id INT UNSIGNED NOT NULL
);
