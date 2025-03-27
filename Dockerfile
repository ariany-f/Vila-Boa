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

# Instala o Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia os arquivos do projeto
WORKDIR /var/www/html
COPY . /var/www/html/

# Copia o script entrypoint
COPY ./.docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Expor a porta 80 (para o Apache)
EXPOSE 80

# Definir o comando para rodar o entrypoint
ENTRYPOINT ["/entrypoint.sh"]
