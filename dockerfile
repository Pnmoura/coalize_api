# Use a imagem oficial do PHP com Apache
FROM php:7.1-apache

# Instale as dependências necessárias para o Composer e MySQL
RUN apt-get update && \
    apt-get install -y \
    unzip \
    libzip-dev \
    zlib1g-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    mariadb-client \
    && docker-php-ext-install zip mysqli pdo_mysql gd

# Instale o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Configure o PHP e o Apache
COPY apache2.conf /etc/apache2/apache2.conf
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Copie a aplicação Yii2 para o diretório correto
COPY . /var/www/html

# Defina o diretório de trabalho como o diretório da aplicação
WORKDIR /var/www/html

# Instale as dependências da aplicação usando o Composer
RUN composer install --no-dev --optimize-autoloader

# Executar as migrações
RUN php yii migrate --interactive=0

# Exponha a porta 80 para o Apache
EXPOSE 80

# Inicie o Apache e o MySQL
CMD ["apache2-foreground"]
