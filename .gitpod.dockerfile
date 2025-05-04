#FROM gitpod/workspace-full:latest
FROM gitpod/workspace-mysql

# optional: use a custom apache config.
COPY etc/apache2/apache2.conf /etc/apache2/apache2.conf
COPY etc/php.ini /etc/php/8.1/apache2/php.ini

# optional: change document root folder. It's relative to your git working copy.
ENV APACHE_DOCROOT_IN_REPO="www"

RUN sudo install-packages php-xdebug
#RUN sed -i "s/;extension=pdo_mysql/extension=pdo_mysql/g" /etc/php/7.2/cli/php.ini
