#!/bin/bash

# This will generate insert-statements for the assindia project.
# It's gonna be dynamic, so one can specify who many values should
# be created, by the script.

echo -n "Insert the number of statements I should produce: "
read -e number
echo -n "Producing $number statements, now."

# Cleaning file
echo -n "" > insertdump.sql

# Filling file
echo -e "USE mahndb" >> insertdump.sql
echo -e "TRUNCATE TABLE tenancies;\n
TRUNCATE TABLE cases;\n
TRUNCATE TABLE costs;\n
TRUNCATE TABLE courts;\n
TRUNCATE TABLE events;\n" >> insertdump.sql
count=1
while [ $number -gt 0 ]
do
# Preparing Inserts
insert="INSERT INTO tenancies (tenancy_ve, tenancy_street, tenancy_street_number, tenancy_zipcode, tenancy_city) VALUES ('dummy$count', '$count. street', '$count', '$count', '$count. city');\n
INSERT INTO cases (case_created, tenancy_id, case_number, case_followup, case_reason, case_type, case_memo) VALUES ('$[$count+2000]-01-01 00:00:00', $count, $count, '$[$count+2000]-10-10', 'Reason $count', 'Zahlungsklage', 'Lorem ipsum, dolor amet.');\n
INSERT INTO costs (cost_date, cost_amount, cost_description, cost_type, case_id) VALUES ('$[$count+2000]-08-08', $count, 'Lorem Ipsum description', 'Hamburger', $count);\n
INSERT INTO courts (court_name, court_street, court_street_number, court_zipcode, court_city) VALUES ('Gericht $count', '$count. street', '$count', '$count', '$count. city');\n
INSERT INTO events (event_date, event_type, event_description, event_file, court_id, case_id) VALUES ('$[$count+2000]-07-07', 'Fanpost', 'Lorem Ipsum description', '/img/file$count.png', $count, $count);\n"

echo -e $insert >> insertdump.sql

number=$[$number-1]
count=$[$count+1]
done
echo -e "Done.\n"
