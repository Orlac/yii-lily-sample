#!/bin/bash
echo -n '' > protected/data/testdrive.db 
echo "DROP DATABASE lily_sample; CREATE DATABASE lily_sample;" |mysql -u root --password=krispo
./protected/yiic dbinstall
sqlite3 protected/data/testdrive.db .dump > protected/data/lily_sample.sqlite.sql
mysqldump -u root --password=krispo lily_sample > protected/data/lily_sample.mysql.sql
