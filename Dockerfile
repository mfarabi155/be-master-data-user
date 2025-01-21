# Gunakan image PHP dengan Apache
FROM php:8.2-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    curl \
    zip \
    unzip \
    git \
    libicu-dev \
    libonig-dev \
    libzip-dev \
    && docker-php-ext-install intl pdo pdo_mysql zip mbstring

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Salin kode Laravel ke dalam container
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Atur permission
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Aktifkan modul Apache
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80

# Perintah default saat container dijalankan
CMD ["apache2-foreground"]
