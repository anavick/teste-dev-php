FROM php:8.2-fpm

# arguments defined in docker-compose.yml
ARG user
ARG uid

# install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev\
    zip \
    && curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    unzip



# clear cache
RUN command apt-get clean && rm -rf /var/lib/apt/lists/*

# install php extensions
RUN command docker-php-ext-install pdo_mysql  pdo_pgsql  mbstring exif pcntl bcmath gd sockets

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN useradd -G www-data,root -u $uid -d /home/$user $user

RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# install redis
RUN command pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

COPY .docker/php/uploads.ini /usr/local/etc/php/conf.d/uploads.ini

# set working directory
WORKDIR /var/www

USER $user


