# Usar imagem oficial do PHP com Apache
FROM php:8.2-apache

# Instalar extensões do PHP necessárias para o CakePHP
RUN apt-get update && apt-get install -y libpng-dev libjpeg62-turbo-dev libfreetype6-dev zip git curl libicu-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd pdo pdo_mysql intl && \
    a2enmod rewrite

# Instalar o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Definir o diretório de trabalho
WORKDIR /var/www/html

# Copiar o conteúdo da aplicação para o container
COPY . /var/www/html

# Rodar o composer install para instalar as dependências do CakePHP
RUN composer install --no-interaction

# Configurar o Apache para usar a pasta "webroot" como a raiz web
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/webroot|' /etc/apache2/sites-available/000-default.conf

# Garantir que o Apache e as permissões da pasta sejam corretas
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# Expor a porta 80 para o servidor web
EXPOSE 80

# Iniciar o Apache em segundo plano
CMD ["apache2-foreground"]
