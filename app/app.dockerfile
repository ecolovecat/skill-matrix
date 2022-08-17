FROM devilbox/php-fpm-8.1:latest
RUN apt-get update && apt-get install -y libzip-dev

# Extension mysql driver for mysql
RUN docker-php-ext-install pdo_mysql mysqli
