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

# Definir o diretório de trabalho
WORKDIR /var/www/html

# Copiar os arquivos do projeto para o contêiner
COPY . /var/www/html/

# Copiar o entrypoint.sh e garantir permissões de execução
COPY .docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Configura o DocumentRoot para o diretório correto (webroot)
RUN echo 'DocumentRoot /var/www/html/webroot' >> /etc/apache2/sites-available/000-default.conf

# Definir o ServerName para evitar o erro
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Expor a porta 80 (para o Apache)
EXPOSE 80

# Configura o script entrypoint para rodar quando o contêiner iniciar
ENTRYPOINT ["/entrypoint.sh"]

CMD apache2-foreground