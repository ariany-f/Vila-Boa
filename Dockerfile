FROM php:8.2-apache

# Atualiza o sistema e instala pacotes necessários
RUN apt-get update -qq && \
    apt-get install -y apt-transport-https ca-certificates libicu-dev libpq-dev zip unzip git && \
    docker-php-ext-install intl pdo pdo_pgsql

# Ativa o mod_rewrite no Apache
RUN a2enmod rewrite

# Habilita outros módulos do Apache, se necessário
RUN a2enmod headers env

# Define a pasta de trabalho no container
WORKDIR /var/www/html

# Copia os arquivos do projeto para o container
COPY . /var/www/html/

# Instala as dependências do Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    composer install --no-dev --optimize-autoloader && \
    composer clear-cache

# Cria as pastas tmp e logs, caso não existam
RUN mkdir -p /var/www/html/tmp /var/www/html/logs

# Define permissões corretas para cache e logs do CakePHP
RUN chown -R www-data:www-data /var/www/html/tmp /var/www/html/logs

# Modifica o arquivo de configuração do Apache para usar o webroot do CakePHP
RUN sed -i 's|/var/www/html|/var/www/html/webroot|g' /etc/apache2/sites-available/000-default.conf

# Expõe a porta 80
EXPOSE 80

# Define o comando para iniciar o Apache
CMD ["apache2-foreground"]
