# Etapa 1: Build da aplicação
FROM php:8.2-cli AS build

# Instala dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libicu-dev \
    libonig-dev \
    libzip-dev \
    libpq-dev \
    curl \
    libxml2-dev \
    libssl-dev \
    && docker-php-ext-install \
    intl \
    opcache \
    pdo \
    pdo_pgsql \
    pdo_mysql \
    zip \
    && apt-get clean

# Instala o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia os arquivos do projeto
COPY . .

# Instala as dependências do CakePHP
RUN composer install --no-dev --optimize-autoloader

# Etapa 2: Configuração do ambiente de execução
FROM php:8.2-apache

# Instala extensões do PHP para produção
RUN apt-get update && apt-get install -y \
    unzip \
    libicu-dev \
    libonig-dev \
    libzip-dev \
    libpq-dev \
    curl \
    libxml2-dev \
    libssl-dev \
    && docker-php-ext-install \
    intl \
    opcache \
    pdo \
    pdo_pgsql \
    pdo_mysql \
    zip \
    && apt-get clean

# Ativa o mod_rewrite do Apache (necessário para CakePHP)
RUN a2enmod rewrite

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia os arquivos do build para a imagem final
COPY --from=build /var/www/html /var/www/html

# Exponha a porta 80
EXPOSE 80

# Define o ponto de entrada do contêiner
CMD ["apache2-foreground"]
