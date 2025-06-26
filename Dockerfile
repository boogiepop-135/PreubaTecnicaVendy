FROM php:8.0-apache

# Instalar y habilitar mysqli
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN a2enmod rewrite

COPY ./inventario_textil /var/www/html/

# Verificar que mysqli está instalado
RUN php -m | grep mysqli
