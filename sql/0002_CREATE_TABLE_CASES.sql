CREATE TABLE cases (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	case_nr INT(4) NOT NULL,
	case_reason TEXT NOT NULL,
	case_memo TEXT NOT NULL,
	case_followup DATE NOT NULL,
	case_created DATETIME NOT NULL,
	case_deleted TINYINT(1) NOT NULL DEFAULT 0,
	tenancy_id INT UNSIGNED NOT NULL,
	case_type_id INT UNSIGNED NOT NULL
);
