# Use a imagem oficial do PHP
FROM php:8.0-cli

# Instale dependências necessárias para o Kafka
RUN apt-get update && \
    apt-get install -y librdkafka-dev && \
    pecl install rdkafka && \
    docker-php-ext-enable rdkafka

# Defina o diretório de trabalho
WORKDIR /usr/src/app

# Exponha a porta do servidor PHP embutido, se necessário
EXPOSE 8000
