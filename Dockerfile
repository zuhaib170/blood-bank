FROM php:8.2-apache

RUN docker-php-ext-install mysqli

COPY . /var/www/html/

RUN sed -i 's/DirectoryIndex .*/DirectoryIndex home.php/' /etc/apache2/mods-enabled/dir.conf

ENV PORT=10000

CMD ["sh", "-c", "sed -i \"s/Listen 80/Listen ${PORT}/; s/<VirtualHost \\*:80>/<VirtualHost *:${PORT}>/" /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf && apache2-foreground"]