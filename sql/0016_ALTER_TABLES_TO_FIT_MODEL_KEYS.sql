ALTER TABLE claimants CHANGE person_id claimant_id INT UNSIGNED NOT NULL;
ALTER TABLE defendants CHANGE person_id defendant_id INT UNSIGNED NOT NULL;
