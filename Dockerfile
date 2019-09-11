FROM wordpress:5.2.3-php7.1-apache

MAINTAINER Andres Julian Lopez <andres.julian@bq.com>

RUN rm -rf /usr/src/wordpress/wp-content/

ADD wp-content/ /usr/src/wordpress/wp-content/

RUN chown -R www-data. /usr/src/wordpress/wp-content/
