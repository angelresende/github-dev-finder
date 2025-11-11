FROM php:8.2-fpm

# Instala dependências do sistema e extensões PHP necessárias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpq-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    vim \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Copia Composer da imagem oficial
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Instala Node.js e npm
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest

# Define diretório de trabalho
WORKDIR /var/www

# Copia arquivos de configuração primeiro (melhora o cache)
COPY composer.json composer.lock ./

# Instala dependências do PHP antes de copiar tudo (mantém cache de build)
RUN composer install --no-scripts --no-autoloader --prefer-dist --no-interaction

# Agora copia o restante do projeto
COPY . .

# Gera autoload e otimiza Composer
RUN composer dump-autoload --optimize

# Ajusta permissões apenas no que é necessário
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]
