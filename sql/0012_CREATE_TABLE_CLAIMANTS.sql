CREATE TABLE claimants (
	case_id INT UNSIGNED NOT NULL,
	person_id INT UNSIGNED NOT NULL,
	PRIMARY KEY(case_id, person_id)
);
