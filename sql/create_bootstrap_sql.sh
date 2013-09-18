# Add all sql-files to a bootstrapping sql-file to start them all with one command
rm bootstrap.sql
for f in *.sql
do
	echo "Adding $f"
	cat $f >> bootstrap.sql
done
