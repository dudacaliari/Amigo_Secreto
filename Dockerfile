# Usa a imagem oficial do PHP com FPM
FROM php:8.1-fpm

# Instala as dependências necessárias do sistema
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    curl \
    libpng-dev \
    libicu-dev \
    libxml2-dev \
    libgmp-dev \
    libonig-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libsodium-dev \
    pkg-config \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install zip \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install intl \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install soap \
    && docker-php-ext-install sockets \
    && docker-php-ext-install sodium \
    && docker-php-ext-install exif \
    && docker-php-ext-install gmp \
    && docker-php-ext-install mysqli

# Copia o Composer para dentro do container
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia os arquivos da aplicação Laravel para dentro do container
COPY . .

# Ajusta permissões para evitar erros
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Instala as dependências do Laravel
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Expõe a porta 8000 para o serviço
EXPOSE 8000

# Comando para iniciar o servidor do Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000
