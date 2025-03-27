#!/bin/bash

# Sai imediatamente se um comando falhar
set -e

# Exibe logs detalhados (opcional para debug)
echo "Iniciando aplicação CakePHP..."

# Instala dependências se necessário
if [ ! -d "vendor" ]; then
    echo "Instalando dependências..."
    composer install --no-dev --optimize-autoloader --no-scripts
fi

# Rodando migrações, caso necessário
if [ "$RUN_MIGRATIONS" = "true" ]; then
    echo "Rodando migrações do banco de dados..."
    bin/cake migrations migrate --no-interaction
fi

# Certificando-se de que as permissões dos arquivos estão corretas
echo "Configurando permissões..."
chown -R www-data:www-data /var/www/html

# Inicia o Apache em modo foreground
echo "Iniciando Apache..."
exec apache2-foreground
