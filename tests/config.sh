#!/usr/bin/env bash

## NOTICE: paths relative should be absolute or relative to the root folder of the project

# Google Cloud Platform Credentials
export GOOGLE_CREDENTIALS="tests/google.json"

# OpenStack Credentials
export OPENSTACK_CREDENTIALS_V2="tests/openstack-v2.sh"
export OPENSTACK_CREDENTIALS_V3="tests/openstack-v3.sh"

# AWS Credentials:
# bash file which exports AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY
export AWS_CREDENTIALS="tests/aws.sh"
