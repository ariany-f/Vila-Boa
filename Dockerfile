# Usa uma imagem PHP com Apache
FROM php:8.1-apache

# Instala as dependências e extensões necessárias para o CakePHP
RUN apt-get update && apt-get install -y \
    apt-transport-https \
    ca-certificates \
    libicu-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install intl pdo pdo_pgsql

# Ativa o mod_rewrite no Apache
RUN a2enmod rewrite

# Define a pasta de trabalho no container
WORKDIR /var/www/html

# Copia os arquivos do projeto para dentro do container
COPY . /var/www/html/

# Cria as pastas tmp e logs, caso não existam
RUN mkdir -p /var/www/html/tmp /var/www/html/logs

# Define permissões corretas para cache e logs do CakePHP
RUN chown -R www-data:www-data /var/www/html/tmp /var/www/html/logs

# Expõe a porta 80
EXPOSE 80

# Define o comando para iniciar o Apache
CMD ["apache2-foreground"]
