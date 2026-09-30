FROM php:8.3-apache

RUN docker-php-ext-install mysqli

RUN echo "ServerTokens ProductOnly" >> /etc/apache2/apache2.conf \
    && echo "ServerSignature Off" >> /etc/apache2/apache2.conf

RUN RUN_PHP_INI="$PHP_INI_DIR/php.ini-production" \
    && cp "$RUN_PHP_INI" "$PHP_INI_DIR/php.ini" \
    && sed -i 's/expose_php = On/expose_php = Off/' "$PHP_INI_DIR/php.ini"

COPY src/ /var/www/html/
