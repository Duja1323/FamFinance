# Étape 1 : Construire le front React
FROM node:20 as build
WORKDIR /app
COPY ./ ./
RUN npm install && npm run build

# Étape 2 : Image PHP + Apache pour Laravel
FROM php:8.2-apache

# Installer les dépendances PHP
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip git curl \
    && docker-php-ext-install pdo pdo_mysql bcmath

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copier le projet
COPY . /var/www/html

# Copier les fichiers React compilés dans le dossier public Laravel
COPY --from=build /app/build /var/www/html/public

# Définir le répertoire de travail
WORKDIR /var/www/html

# Installer les dépendances Laravel
RUN composer install --no-dev --optimize-autoloader

# Donner les bonnes permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Exposer le port
EXPOSE 80

# Lancer Apache
CMD ["apache2-foreground"]
