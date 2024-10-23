# Usa a imagem oficial do PHP 8.1 com FPM
FROM php:8.1-fpm

# Instala dependências necessárias do sistema
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    libpng-dev \
    libicu-dev \
    libxml2-dev \
    libgmp-dev \
    libonig-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libssl-dev \
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

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia os arquivos da aplicação Laravel para dentro do container
COPY . .

# Instala as dependências do Laravel com Composer
RUN composer install --no-dev --optimize-autoloader

# Ajusta permissões para os diretórios necessários
RUN chmod -R 775 storage bootstrap/cache

# Expõe a porta 8000 para o serviço
EXPOSE 8000

# Comando para iniciar o servidor do Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000
