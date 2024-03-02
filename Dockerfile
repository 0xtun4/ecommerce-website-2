# Use an official CentOS-based PHP runtime as a parent image
FROM php:7.4-apache

# Set the working directory in the container
WORKDIR /var/www/html

# Copy your PHP application code into the container
COPY webapp/ /var/www/html/

# Install PHP extensions and other dependencies
RUN chown -R www-data:www-data /var/www &&\
    yum install -y epel-release && \
    yum install -y php-gd php-pdo php-pdo_mysql && \
    yum clean all

# Expose the port Apache listens on
EXPOSE 80

# Start Apache when the container runs
CMD ["httpd", "-DFOREGROUND"]
