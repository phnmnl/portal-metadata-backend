#!/usr/bin/env bash

# set web server port
web_server_port=${1:-8080}

# start the web server
php -S 0.0.0.0:${web_server_port} -t public index.php