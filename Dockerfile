# Usa uma imagem PHP com Apache
FROM php:8.1-apache

# Atualiza o sistema e instala pacotes necessários, incluindo o PostgreSQL client
RUN apt-get update -qq && apt-get install -y \
    apt-transport-https \
    ca-certificates \
    libicu-dev \
    libpq-dev \  # Adiciona o pacote necessário para PostgreSQL
    zip \
    unzip \
    git \
    && docker-php-ext-install intl pdo pdo_pgsql

# Ativa o mod_rewrite no Apache
RUN a2enmod rewrite

# Define a pasta de trabalho no container
WORKDIR /var/www/html

# Copia os arquivos do projeto para o container
COPY . /var/www/html/

# Cria as pastas tmp e logs, caso não existam
RUN mkdir -p /var/www/html/tmp /var/www/html/logs

# Define permissões corretas para cache e logs do CakePHP
RUN chown -R www-data:www-data /var/www/html/tmp /var/www/html/logs

# Expõe a porta 80
EXPOSE 80

# Define o comando para iniciar o Apache
CMD ["apache2-foreground"]
