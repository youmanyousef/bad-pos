#!/bin/bash
#
#Load in databases

mysql -u root -proot -e "CREATE DATABASE IF NOT EXISTS customers;"
mysql -u root -proot -e "CREATE DATABASE IF NOT EXISTS users;"


mysql -u root -proot customers < /docker-entrypoint-initdb.d/customers.sql
mysql -u root -proot users < /docker-entrypoint-initdb.d/users.sql
