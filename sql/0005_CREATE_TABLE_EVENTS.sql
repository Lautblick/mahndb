CREATE TABLE events (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	event_date DATE NOT NULL,
	event_description TEXT NOT NULL,
	event_file VARCHAR(255) NOT NULL,
	event_type_id INT UNSIGNED NOT NULL,
	court_id INT UNSIGNED NOT NULL,
	case_id INT UNSIGNED NOT NULL
);
