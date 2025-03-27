FROM jorgegonzalezcakedc/cakephp-runner

# Se necessário, adicione suas customizações, como pacotes extras
# Por exemplo, instalar pacotes adicionais ou outras dependências

# Instalar dependências adicionais, se necessário
RUN apt-get update && apt-get install -y \
    curl \
    vim \
    && rm -rf /var/lib/apt/lists/*

# Copiar arquivos de configuração, se necessário
# COPY ./custom_config.ini /etc/php.ini

# Se você precisar rodar alguma configuração de inicialização, pode adicionar comandos aqui
