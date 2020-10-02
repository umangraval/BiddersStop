FROM php:7.4-cli
COPY . /usr/src/myapp
WORKDIR /usr/src/myapp
RUN apt-get update && apt-get install -y autoconf build-essential
RUN pecl install mongodb
RUN echo "extension=mongo.so" > /usr/local/etc/php/conf.d/mongo.ini
EXPOSE 8000
CMD ["php -S", "0.0.0.0:8000"]