# Use a imagem oficial do PHP com Apache
FROM php:8.2-apache

# Instala dependências necessárias
RUN apt-get update -qq && \
    apt-get install -y \
    libicu-dev \
    libpq-dev \
    zip \
    git \
    && docker-php-ext-install \
    intl \
    pdo \
    pdo_pgsql \
    && apt-get clean

# Ativa o módulo de reescrita do Apache (necessário para CakePHP)
RUN a2enmod rewrite

# Definir o ServerName para evitar o erro
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Instala o Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Definir o diretório de trabalho
WORKDIR /var/www/html

# Copiar os arquivos do projeto para o contêiner
COPY . /var/www/html/

# Instalar as dependências do CakePHP com o Composer
RUN composer install --no-dev --optimize-autoloader && \
    composer clear-cache

# Definir permissões de diretório
RUN mkdir -p /var/www/html/tmp /var/www/html/logs && \
    chown -R www-data:www-data /var/www/html/tmp /var/www/html/logs

# Expor a porta 80 (para o Apache)
EXPOSE 80

# Comando para rodar o Apache no foreground
CMD ["apache2-foreground"]
