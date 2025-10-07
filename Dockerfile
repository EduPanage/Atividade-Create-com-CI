# Usa a imagem oficial do PHP com Apache
FROM php:8.2-apache

# 1. Instala os pacotes de sistema necessários (libsqlite3-dev)
#    Eles são necessários para o 'pdo_sqlite'.
RUN apt-get update && \
    apt-get install -y libsqlite3-dev && \
    rm -rf /var/lib/apt/lists/*

# 2. Instala APENAS a extensão pdo_sqlite. 
#    A extensão 'sqlite3' (para new SQLite3) geralmente é ativada automaticamente.
RUN docker-php-ext-install pdo_sqlite

# Define o diretório de trabalho dentro do container
WORKDIR /var/www/html

# Copia todos os seus arquivos de projeto para o diretório web do Apache
COPY . /var/www/html/

# Cria o diretório 'data' e garante que o Apache/PHP tenha permissão de escrita
RUN mkdir -p /var/www/html/data && chown -R www-data:www-data /var/www/html/data