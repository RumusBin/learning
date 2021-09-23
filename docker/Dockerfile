FROM ubuntu:20.04

ENV TZ=Europe/Kiev

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update \
    && apt-get install -y  software-properties-common \
    && add-apt-repository ppa:ondrej/php \
    && apt-get update \
    && DEBIAN_FRONTEND=noninteractive apt-get install -y \
      git \
      curl \
      unzip \
      php8.0-fpm \
      php8.0-bcmath \
      php8.0-curl \
      php8.0-gd \
      php8.0-mbstring \
      php8.0-mysql \
      php8.0-xml \
      php8.0-zip \
      php8.0-apcu \
      php8.0-xdebug \
    && mkdir /var/run/php \
    && rm -rf /var/lib/apt/lists/*

#Composer install
RUN curl -o /tmp/composer-setup.php https://getcomposer.org/installer \
&& curl -o /tmp/composer-setup.sig https://composer.github.io/installer.sig \
&& php -r "if (hash('SHA384', file_get_contents('/tmp/composer-setup.php')) !== trim(file_get_contents('/tmp/composer-setup.sig'))) { unlink('/tmp/composer-setup.php'); echo 'Invalid installer' . PHP_EOL; exit(1); }" \
&& php /tmp/composer-setup.php --no-ansi --install-dir=/usr/local/bin --filename=composer --version=2.1.7 \
&& rm -f /tmp/composer-setup.*

# Tune PHP settings
RUN sed -i 's,listen = /run/php/php8.0-fpm.sock,listen = 9000,g' /etc/php/8.0/fpm/pool.d/www.conf \
    && sed -i 's,pm.max_children.*,pm.max_children = 20,g' /etc/php/8.0/fpm/pool.d/www.conf \
    && sed -i 's,upload_max_filesize.*,upload_max_filesize = 10G,g' /etc/php/8.0/fpm/php.ini \
    && sed -i 's,memory_limit = 128M,memory_limit = 256M,g' /etc/php/8.0/fpm/php.ini \
    && sed -i 's,max_execution_time = 30,max_execution_time = 600,g' /etc/php/8.0/fpm/php.ini \
    && sed -i 's,max_execution_time = 30,max_execution_time = 0,g' /etc/php/8.0/cli/php.ini \
    && sed -i 's,post_max_size.*,post_max_size = 10G,g' /etc/php/8.0/fpm/php.ini \
    && sed -i 's,^.*max_input_vars.*,max_input_vars = 5000,g' /etc/php/8.0/fpm/php.ini \
    && sed -i 's,^.*zend.exception_ignore_args.*,zend.exception_ignore_args = Off,g' /etc/php/8.0/fpm/php.ini


COPY entrypoint.sh /entrypoint.sh


WORKDIR /var/www/html

ENTRYPOINT ["/bin/bash", "/entrypoint.sh"]
CMD ["php-fpm8.0", "-OF"]
