# Escolhe a imagem PHP com extensões necessárias para Laravel
FROM php:8.1-fpm

# Instala dependências do sistema
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libonig-dev libzip-dev curl \
    && docker-php-ext-install pdo pdo_mysql

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia os arquivos da aplicação para o contêiner
COPY . .

# Instala as dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# Configura permissões
RUN chmod -R 775 storage bootstrap/cache

# Define a porta que o contêiner vai expor
EXPOSE 8000

# Comando para iniciar o servidor PHP embutido
CMD php artisan serve --host=0.0.0.0 --port=8000
