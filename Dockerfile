FROM php:8.2-fpm

# Instala pacotes necessários
RUN apt-get update -qq && \
    apt-get install -y libicu-dev libpq-dev zip unzip git && \
    docker-php-ext-install intl pdo pdo_pgsql

# Instala o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

# Copia o composer.json e o composer.lock antes de copiar o código
COPY composer.json composer.lock /var/www/html/

# Instala dependências do Composer
RUN composer install --no-dev --optimize-autoloader && \
    composer clear-cache

# Copia os arquivos restantes do projeto
COPY . /var/www/html/

# Define permissões para as pastas tmp e logs
RUN mkdir -p /var/www/html/tmp /var/www/html/logs && \
    chown -R www-data:www-data /var/www/html/tmp /var/www/html/logs

CMD ["php-fpm"]
