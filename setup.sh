#!/usr/bin/env bash

set -o nounset
set -o errexit

function info() {
  echo -e "$@" >&2
}

function log() {
  echo -e "$(date +"%F %T") [${BASH_SOURCE}] -- $@" >&2
}

function on_interrupt(){
    log "Interrupted at line ${BASH_LINENO[0]} running command ${BASH_COMMAND}"
}

function on_error(){
    log "Error at line ${BASH_LINENO[0]} running command ${BASH_COMMAND}"
}

# register trap handlers
trap on_error ERR
trap on_interrupt INT TERM

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

# if the template has been removed, use the actual file as template
if [[ ! -f ${settings_template_file} ]]; then
    mv ${settings_file} ${settings_template_file}
fi

# update GALAXY settings
cat ${settings_template_file} | sed \
  -e "s@\"url\" => \"<GALAXY_URL>\"@\"url\" => \"${GALAXY_URL}\"@" \
  -e "s@\"api_key\" => \"<GALAXY_API_KEY>\"@\"api_key\" => \"${GALAXY_API_KEY}\"@" \
  -e "s@'folder' => getenv('PROVIDERS_DIR')@'folder' => '${PROVIDERS_DIR}'@" \
  > ${settings_file}



########################################################################################################################
# Initialize the MySQL Database
########################################################################################################################
METADATA_TABLE_NAME="user"
#exists_db=$(mysql -u ${MYSQL_USER} -p${MYSQL_PASSWORD} -e "show databases;" | grep ${MYSQL_DATABASE} | wc -l)
exists_metadata_table=$(mysql -u ${MYSQL_USER} -p${MYSQL_PASSWORD} -e \
  "select count(*) from information_schema.tables where table_schema='${MYSQL_DATABASE}' and table_name='${METADATA_TABLE_NAME}';" | grep -Eo '[0-1]')
info "Generating DB schema..."
propel sql:build --config-dir schema --schema-dir schema --output-dir schema
propel config:convert --config-dir schema --output-dir schema/generated-conf
info "Generating DB schema... DONE"
if [[ ${exists_metadata_table} -eq 0 ]]; then
    info "Creating DB..."
    propel sql:insert --config-dir schema --sql-dir schema
    info "Creating DB... DONE"
else
    info "DB already initialized "
    info "Generating migrations..."
    propel diff --config-dir schema --schema-dir schema --output-dir schema/migrations
    info "Applying migrations ..."
    propel migrate --config-dir schema --output-dir schema/migrations
fi
