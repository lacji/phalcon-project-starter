## Description

Application sample for Phalcon framework using docker / docker-compose.

### Version

PHP : `~8.0` \
PSR : `1.1.0` \
Phalcon : `5.0.0-beta.3`

### Configuration

Some variable are available in a `.env` file.

### Start application

    docker-composer run

### Update dependencies

    docker exec -w /var/www/html phalcon-starter_fpm_1 composer update
