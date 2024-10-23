# Usa a imagem oficial do PHP com Apache
FROM php:8.1-apache

# Instala dependências do sistema e extensões necessárias do PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    default-mysql-client \
    git \
    unzip \
    curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia os arquivos do projeto para o contêiner
COPY . .

# Dá permissões corretas às pastas necessárias
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Instala as dependências do Laravel sem os pacotes de desenvolvimento
RUN composer install --no-dev --optimize-autoloader

# Habilita o módulo rewrite do Apache
RUN a2enmod rewrite

# Exponha a porta 80 para acesso externo
EXPOSE 80

# Inicia o Apache quando o contêiner é iniciado
CMD ["apache2-foreground"]
