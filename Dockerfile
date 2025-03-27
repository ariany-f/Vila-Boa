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

# Cria um usuário não root
RUN useradd -ms /bin/bash cakephp
USER cakephp

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia os arquivos do projeto
COPY --chown=cakephp:cakephp . .

# Etapa 2: Imagem final
FROM php:8.2-cli

# Instala dependências do sistema para runtime
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

# Instala o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Cria usuário e define permissões
RUN useradd -ms /bin/bash cakephp
USER cakephp

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia os arquivos gerados na etapa de build
COPY --from=build --chown=cakephp:cakephp /var/www/html /var/www/html

# Exponha a porta usada pela aplicação
EXPOSE 8080

# Copia o script de entrada
COPY --chown=cakephp:cakephp .docker/entrypoint.sh /entrypoint.sh

# Dá permissão de execução ao entrypoint
RUN chmod +x /entrypoint.sh

# Define o script como ponto de entrada
ENTRYPOINT ["/entrypoint.sh"]