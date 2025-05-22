FROM php:8.2-fpm

# Установка системных зависимостей и необходимых библиотек
RUN apt-get update && apt-get install -y \
    cron \
    supervisor \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libpq-dev \
    libzip-dev \
    libonig-dev \
    libz-dev \
    libssl-dev \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql pgsql mbstring exif pcntl bcmath gd zip

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Установка Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs

WORKDIR /var/www/html

# Копирование и установка зависимостей
COPY . /var/www/html

COPY ./docker/php.ini /usr/local/etc/php/

# Копируем cron-задачу в контейнер
COPY cron /etc/cron.d/laravel-cron

# Устанавливаем права доступа для cron-задачи
RUN chmod 0644 /etc/cron.d/laravel-cron

# Запускаем cron-демон в фоновом режиме
RUN crontab /etc/cron.d/laravel-cron

# Запускаем cron-демон и php-fpm
CMD ["/usr/bin/supervisord"]
