# Usa a imagem oficial do PHP com FPM para Laravel
FROM php:8.2-fpm

# Instala dependências do sistema e extensões PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia os arquivos do Laravel para o contêiner
COPY . /var/www/html

# Define permissões para o diretório de armazenamento e cache do Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Executa o Composer para instalar as dependências do Laravel
RUN composer install --optimize-autoloader --no-dev

# Expõe a porta do PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]