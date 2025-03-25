# Usa a imagem oficial do PHP com Apache
FROM php:8.2-apache

# Instala extensões necessárias para CakePHP
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    libicu-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd intl pdo pdo_mysql opcache

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia os arquivos da aplicação
COPY . .

# Permissões
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/tmp \
    && chmod -R 775 /var/www/html/logs

# Ativa mod_rewrite para URLs amigáveis do CakePHP
RUN a2enmod rewrite

# Expõe a porta do Apache
EXPOSE 80

# Define o comando padrão
CMD ["apache2-foreground"]
