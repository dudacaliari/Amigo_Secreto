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
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definir o diretório de trabalho
WORKDIR /var/www

# Copiar o conteúdo do projeto para o contêiner
COPY . .

# Instalar as dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# Copiar o arquivo .env.example para .env
COPY .env.example .env

# Gerar a chave da aplicação Laravel
RUN php artisan key:generate

# Expor a porta que o PHP-FPM está escutando
EXPOSE 9000

# Iniciar o PHP-FPM
CMD ["php-fpm"]