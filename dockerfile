FROM php:8.0-apache
WORKDIR /var/www/html
COPY src/SalesTaxCalculator.php SalesTaxCalculator.php
COPY src/index.html index.html
COPY src/ src
EXPOSE 80
