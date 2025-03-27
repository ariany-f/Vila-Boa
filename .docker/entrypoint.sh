#!/bin/bash

# Sai imediatamente se um comando falhar
set -e

# Exibe logs detalhados (opcional para debug)
echo "Iniciando aplicação CakePHP..."

# Instala as dependências do Composer (caso não tenha sido feito previamente)
export COMPOSER_ALLOW_SUPERUSER=1
composer install --no-dev --optimize-autoloader --no-scripts -v

# Executa qualquer migração pendente do banco de dados (opcional)
if [ "$RUN_MIGRATIONS" = "true" ]; then
  echo "Rodando migrations..."
  # Rodar as migrações do banco de dados do CakePHP
  php bin/cake migrations migrate --no-interaction
  php bin/cake migrations seed --no-interaction  # Para carregar dados iniciais, se necessário
fi

# Se você tiver algum serviço como a fila, cache ou outras configurações, pode iniciar aqui
# Exemplo: Iniciar a fila de tarefas
# php bin/cake queue:work

# Exibe as permissões da pasta (debug)
ls -la /app

# Verifica se está em produção ou desenvolvimento e inicia o servidor embutido para desenvolvimento
if [ "$APP_ENV" = "production" ]; then
  # Se estiver em produção, o Apache ou outro servidor HTTP pode ser usado (já configurado no Dockerfile)
  echo "Ambiente de produção detectado. Servidor HTTP Apache já configurado."
else
  # Para desenvolvimento, podemos iniciar o servidor embutido do PHP
  echo "Ambiente de desenvolvimento detectado. Iniciando servidor embutido PHP."
  exec php -S 0.0.0.0:8080 -t webroot
fi
