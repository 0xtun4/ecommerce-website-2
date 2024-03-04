FROM php:latest
WORKDIR /var/www/html
COPY web/ /var/www/html
CMD ["php", "-S", "0.0.0.0:80"]
EXPOSE 80
