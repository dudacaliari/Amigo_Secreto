# Usar a imagem oficial do PHP 8.3 com Apache
FROM php:8.3.12-fpm

# Instalar as extensões do PHP necessárias
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install gd \
    && docker-php-ext-install intl \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install soap \
    && docker-php-ext-install sockets \
    && docker-php-ext-install sodium \
    && docker-php-ext-install exif \
    && docker-php-ext-install gmp \
    && docker-php-ext-install mysqli

# Instalar o Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Habilitar o módulo de reescrita do Apache
RUN a2enmod rewrite

# Definir o diretório de trabalho
WORKDIR /var/www/html

# Copiar o restante dos arquivos do projeto para o contêiner
COPY . .

# Instalar as dependências do Laravel
RUN composer install

# Copiar as permissões de pastas
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expor a porta 80
EXPOSE 80
