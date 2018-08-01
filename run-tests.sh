#!/usr/bin/env bash

set -e

SCRIPT_NAME="$(basename ${BASH_SOURCE[0]})"
CURRENT_PATH="$(pwd)"
ROOT_PATH="${CURRENT_PATH}"
COMPOSER="${ROOT_PATH}/composer.phar"
TESTS_PATH="${ROOT_PATH}/tests"
CONFIG_PATH="${TESTS_PATH}/config.sh"

V2_TEST_PATH="${TESTS_PATH}/Functional/v2"

# Load config
source ${CONFIG_PATH}

# AWS Tests
source ${AWS_CREDENTIALS}
${COMPOSER} test ${V2_TEST_PATH}/providers/AwsMetadataTest.php

# Google Tests
${COMPOSER} test ${V2_TEST_PATH}/providers/GoogleCloudMetadataTest.php

# OpenStack Tests
source ${OPENSTACK_CREDENTIALS_V2}
${COMPOSER} test ${V2_TEST_PATH}/providers/OpenStackMetadataV2Test.php

source ${OPENSTACK_CREDENTIALS_V3}
${COMPOSER} test ${V2_TEST_PATH}/providers/OpenStackMetadataV3Test.php


# Run UserDeployments Tests
USER_DEPLOYMENTS_TESTS="${V2_TEST_PATH}/userDeployments"
for t in $(ls "${V2_TEST_PATH}/userDeployments")
do
    if [[ ${t} != ${SCRIPT_NAME} ]]; then
        echo "Running test ${t}..."
        ${COMPOSER} test "${USER_DEPLOYMENTS_TESTS}/${t}"
    fi
done