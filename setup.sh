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
sed "s/user: <MYSQL_USER>/user: ${MYSQL_USER}/" | \
sed "s/password: <MYSQL_PASSWORD>/password: ${MYSQL_PASSWORD}/" > ${current_propel_file}


########################################################################################################################
# Update 'settings.php' configuration file
########################################################################################################################
settings_file="src/settings.php"
settings_template_file="src/settings.php.template"

# if the template has been remove, use the actual file as template
if [[ ! -f ${settings_template_file} ]]; then
    mv ${settings_file} ${settings_template_file}
fi

# update GALAXY settings
sed "s@\"url\" => \"<GALAXY_URL>\"@\"url\" => \"${GALAXY_URL}\"@g" ${settings_template_file} | \
sed "s@\"api_key\" => \"<GALAXY_API_KEY>\"@\"api_key\" => \"${GALAXY_API_KEY}\"@g" > ${settings_file}



########################################################################################################################
# Initialize the MySQL Database
########################################################################################################################
propel sql:build --config-dir schema --schema-dir schema
propel config:convert --config-dir schema --output-dir schema/generated-conf
propel sql:insert --config-dir schema