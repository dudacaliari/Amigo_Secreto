# Usa a imagem oficial do PHP com Apache
FROM php:8.1-apache

# Instala extensões necessárias (incluindo extensões MySQL)
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    unzip \
    git \
    default-mysql-client \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Habilita o módulo de regravação do Apache
RUN a2enmod rewrite

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia os arquivos do projeto para o contêiner
COPY . .

# Instala as dependências do Laravel
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Dá permissões corretas para as pastas de cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Exponha a porta 80 para o Apache
EXPOSE 80

# Comando para iniciar o Apache
CMD ["apache2-foreground"]
