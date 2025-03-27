# Usa a imagem do PHP com Apache
FROM php:8.1-apache

# Instala extensões necessárias para o CakePHP
RUN apt-get update && apt-get install -y \
    libicu-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install intl pdo pdo_mysql

# Ativa o mod_rewrite para o Apache
RUN a2enmod rewrite

# Define a pasta de trabalho no container
WORKDIR /var/www/html

# Copia os arquivos do projeto para dentro do container
COPY . /var/www/html/

# Define permissões corretas para a pasta de logs e cache do CakePHP
RUN chown -R www-data:www-data /var/www/html/tmp /var/www/html/logs

# Expõe a porta 80
EXPOSE 80

# Define o comando de inicialização do Apache
CMD ["apache2-foreground"]
