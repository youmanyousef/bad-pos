#
#


FROM php:7.3-apache
RUN docker-php-ext-install mysqli pdo_mysql
RUN a2enmod rewrite


#FROM mysql:5.7.31
#ENV MYSQL_ROOT_PASSWORD=root

WORKDIR /var/www/html

COPY --chown=www-data:www-data . .
#COPY ./users.sql /docker-entrypoint-initdb.d/users.sql
#COPY ./customers.sql /docker-entrypoint-initdb.d/users.sql
USER www-data

#CMD ["mysqld"]
