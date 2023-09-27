Project starter for Phalcon framework.

### Configuration

##### `.env` file

Change environment variables from the `.env` file

    ...
    PHP_VERSION=8.1
    POSTGRES_VERSION=12.0
    ...

Then build images 

    docker compose build

##### `--build-arg` argument

Build docker images using command line argument

    docker compose build --build-arg PHP_VERSION=8.1 --build-arg POSTGRES_VERSION=12.0

### Start application

    docker compose up
