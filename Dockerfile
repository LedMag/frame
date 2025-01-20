FROM php:8.2-fpm

RUN docker-php-ext-install pdo pdo_mysql

COPY nginx.conf /etc/nginx/nginx.conf

EXPOSE 80

CMD ["php-fpm"]
