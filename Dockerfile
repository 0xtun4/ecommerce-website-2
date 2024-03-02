# Use an official CentOS-based PHP runtime as a parent image
FROM centos:latest

# Set the working directory in the container
WORKDIR /var/www/html

# Copy your PHP application code into the container
COPY . .

# Install PHP extensions and other dependencies
RUN yum install -y epel-release && \
    yum install -y php-gd php-pdo php-pdo_mysql && \
    yum clean all

# Expose the port Apache listens on
EXPOSE 80

# Start Apache when the container runs
CMD ["httpd", "-DFOREGROUND"]
