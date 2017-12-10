#!/usr/bin/env bash

########################################################################################################################
# Setup MYSQL connection
########################################################################################################################
current_propel_file="schema/propel.yaml"
template_propel_file="schema/propel.yaml.template"

# if the template has been remove, use the actual file as template
if [[ ! -f ${template_propel_file} ]]; then
    mv ${current_propel_file} ${template_propel_file}
fi

# update MYSQL settings
sed "s/dsn: \"mysql:host=localhost;dbname=phenomenal\"/dsn: \"mysql:host=${MYSQL_HOST};dbname=phenomenal\"/" ${template_propel_file} | \
sed "s/user: root/user: ${MYSQL_USER}/" | \
sed "s/password: 12345678/password: ${MYSQL_PASSWORD}/" > ${current_propel_file}
