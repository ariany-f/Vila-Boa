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

# Cria diretórios temporários e de logs, com permissões para o PHP-FPM
RUN mkdir -p /var/www/html/tmp /var/www/html/logs && \
    chown -R www-data:www-data /var/www/html/tmp /var/www/html/logs

# Define permissões adequadas para o diretório de trabalho e logs
RUN chmod -R 755 /var/www/html && \
    chown -R www-data:www-data /var/www/html

# Expondo a porta 9000 para o PHP-FPM
EXPOSE 9000

# Define o comando para rodar o PHP-FPM
CMD ["php-fpm"]
