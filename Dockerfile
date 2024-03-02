FROM centos/php-74-centos7

WORKDIR /var/www/html

COPY webapp/ /var/www/html/

RUN yum install -y epel-release && \
    yum install -y php-gd php-pdo php-pdo_mysql && \
    yum clean all && \
    chown -R apache:apache /var/www/html

EXPOSE 80

CMD ["httpd", "-DFOREGROUND"]
