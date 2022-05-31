FROM composer:latest as composer
COPY --from=composer /usr/bin/composer /usr/local/bin/composer

FROM php:8.0-fpm

ENV	PHP_VERSION=8.0 \
    PSR_VERSION=1.1.0 \
    PHALCON_VERSION=5.0.0beta3
#    LANG=en_US.UTF-8 \
#    LANGUAGE=en_US.UTF-8 \
#    LC_ALL=en_US.UTF-8 \
#    TZ=Pacific/Noumea

# Import fpm config file
COPY www.conf /etc/php/${PHP_VERSION}/fpm/pool.d/www.conf

# Install psr
RUN set -xe \
    && curl -LO https://github.com/jbboehr/php-psr/archive/v${PSR_VERSION}.tar.gz \
    && tar xzf ${PWD}/v${PSR_VERSION}.tar.gz \
    && docker-php-ext-install -j $(getconf _NPROCESSORS_ONLN) ${PWD}/php-psr-${PSR_VERSION}

# Install phalcon
RUN set -xe \
    && curl -LO https://github.com/phalcon/cphalcon/archive/refs/tags/v${PHALCON_VERSION}.tar.gz \
    && tar xzf ${PWD}/v${PHALCON_VERSION}.tar.gz \
    && cd ${PWD}/cphalcon-${PHALCON_VERSION}/build \
    && ./install \
    && docker-php-ext-enable phalcon

# Clean up image
RUN apt -y remove curl \
    && apt -y --purge autoremove \
    && apt -y autoclean \
    && apt -y clean \
    && rm -rf /var/lib/apt/lists/* \
    && rm -rf /tmp/* /var/tmp/* \
    && rm -r ${PWD}/v${PSR_VERSION}.tar.gz ${PWD}/php-psr-${PSR_VERSION} \
    && rm -r ${PWD}/v${PHALCON_VERSION}.tar.gz ${PWD}/cphalcon-${PHALCON_VERSION}

# Import script
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN ["chmod", "+x", "/usr/local/bin/entrypoint.sh"]

# Setup / Run service
CMD ["/usr/local/bin/entrypoint.sh","php-fpm","-F"]