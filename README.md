# Portal Metadata Backend

Version: 2.0.0

## Description

Metadata service for the PhenoMeNal Portal.


## Installation

As a requirement to install the Portal Metadata Backend you need running instances of both MySQL and Galaxy servers. 
Accordingly to their configuration, set the following parameters in your environement:

* `MYSQL_USER`
* `MYSQL_PASSWORD`
* `MYSQL_HOST`
* `GALAXY_URL`
* `GALAXY_API_KEY`

... and run `./setup.sh` to configure your Metatada Backend.

Finally, to start the server launch the following command:

```
start.sh <SERVICE-PORT>
```

... where `<SERVICE-PORT>` is the port which your metadata server will listen on.


## Key features

- Local Cloud Research Environment Deployment
- Metadata server

## Functionality

- Other Tools


## Tool Authors

- Sijin He (EMBL-EBI)
- Marco Enrico Piras (CRS4)


## Git Repository

- https://github.com/phnmnl/portal-metadata-backend.git