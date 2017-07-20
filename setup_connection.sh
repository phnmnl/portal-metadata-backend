#!/bin/bash

mv schema/propel.yaml schema/propel_orig.yaml
sed "s/mysql:host=localhost;dbname=phenomenal/mysql:host=$MYSQL_HOST;dbname=phenomenal/" schema/propel_orig.yaml | \
sed "s/user: root/user: $MYSQL_USER/" | \
sed "s/password: 12345678/password: $MYSQL_PASSWORD/" > schema/propel.yaml
