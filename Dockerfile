FROM bitnami/php-fpm:7.3-prod
RUN apt-get update && apt-get install -y autoconf build-essential
RUN pecl install mongodb
RUN echo "extension=mongodb.so" >> /opt/bitnami/php/etc/php.ini
WORKDIR /code
COPY . /code
EXPOSE 8000
#CMD['php','-S','localhost:8000']
