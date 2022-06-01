ARG PHP_VERSION
FROM php:${PHP_VERSION}-fpm

ARG PSR_VERSION
ARG PHALCON_VERSION

# Install psr
RUN cd /tmp \
    && curl -LO https://github.com/jbboehr/php-psr/archive/v${PSR_VERSION}.tar.gz \
    && tar xzf /tmp/v${PSR_VERSION}.tar.gz \
    && docker-php-ext-install -j $(getconf _NPROCESSORS_ONLN) /tmp/php-psr-${PSR_VERSION} \
    && rm -r /tmp/v${PSR_VERSION}.tar.gz /tmp/php-psr-${PSR_VERSION}

# Install phalcon
RUN cd /tmp \
    && curl -LO https://github.com/phalcon/cphalcon/archive/refs/tags/v${PHALCON_VERSION}.tar.gz \
    && tar xzf /tmp/v${PHALCON_VERSION}.tar.gz \
    && cd /tmp/cphalcon-${PHALCON_VERSION}/build \
    && ./install \
    && docker-php-ext-enable phalcon \
    && rm -r /tmp/v${PHALCON_VERSION}.tar.gz /tmp/cphalcon-${PHALCON_VERSION}

# Import fpm config file
COPY www.conf /etc/php/${PHP_VERSION}/fpm/pool.d/www.conf

# Import composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Import setup script
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Setup script / Start fpm service
CMD ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm","-F"]