#!/bin/bash
set -e

# Verifica e instala dependências se necessário
if [ -f "composer.json" ]; then
    composer install --no-interaction --optimize-autoloader
fi

# Configura permissões de diretórios
chmod -R 777 logs
chmod -R 777 tmp

# Executa migrações do banco de dados se necessário
# if [ -f "bin/cake.php" ]; then
#     bin/cake.php migrations migrate || true
# fi

# Inicia o servidor PHP embutido
exec php -S 0.0.0.0:8080 -t webroot