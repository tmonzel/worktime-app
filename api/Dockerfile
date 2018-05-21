FROM php:7.2-apache

# Installing needed stuff
RUN apt-get update && apt-get install -y \
		git \
		unzip \
		zip \
	--no-install-recommends && rm -r /var/lib/apt/lists/*

# Install php extensions
RUN docker-php-ext-install pdo_mysql

# Activate mod_rewrite module
RUN a2enmod rewrite

# Install composer from docker image
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Set the working directory for our application
WORKDIR /app/

# Copy composer dependecies
COPY composer.json composer.lock /app/
RUN composer install --no-plugins --no-scripts