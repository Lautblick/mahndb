CREATE TABLE def_lawyers (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	def_lawyer_ref VARCHAR(255) NOT NULL,
	person_id INT UNSIGNED NOT NULL,
	case_id INT UNSIGNED NOT NULL		
);