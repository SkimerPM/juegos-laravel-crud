# Usar una imagen base de PHP con Apache o Nginx
FROM php:8.2-apache

# Instalar dependencias del sistema necesarias
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libzip-dev \
    unzip \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_pgsql zip gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar el código de la aplicación
COPY . .

# Configurar permisos para Laravel storage y cache
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Instalar dependencias de PHP y Node.js, y compilar assets
# NOTA: En Render, estos comandos se mueven al "Build Command" en la configuración del servicio web.
# Los dejamos aquí solo como referencia de lo que se necesita.

# Exponer el puerto para el servidor web (Apache)
EXPOSE 80

# Configurar Apache para Laravel
COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# Iniciar Apache
CMD ["apache2-foreground"]