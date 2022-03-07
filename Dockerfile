FROM php:5-apache

COPY ./config/php.ini $PHP_INI_DIR/conf.d/xvwa.ini
COPY ./config/apache.conf /etc/apache2/sites-available/xvwa.conf

# Upgrade + install driver
RUN apt update -y \
	&& apt upgrade -y \
	&& docker-php-ext-install mysqli pdo pdo_mysql \
	&& a2enmod rewrite \
	&& a2ensite xvwa

EXPOSE 8080
