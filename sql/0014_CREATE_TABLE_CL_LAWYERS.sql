CREATE TABLE cl_lawyers (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	cl_lawyer_ref VARCHAR(255) NOT NULL,
	cl_lawyer_charged DATE NOT NULL,
	person_id INT UNSIGNED NOT NULL,
	case_id INT UNSIGNED NOT NULL		
);
