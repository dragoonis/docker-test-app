FROM php:5.6-fpm

# Install Dependencies
RUN apt-key adv --keyserver hkp://pgp.mit.edu:80 --recv-keys 573BFD6B3D8FBC641079A6ABABF5BD827BD9BF62
RUN echo "deb http://nginx.org/packages/mainline/debian/ jessie nginx" >> /etc/apt/sources.list

ENV NGINX_VERSION 1.9.9-1~jessie

RUN apt-get update && \
    apt-get install -y ca-certificates nginx=${NGINX_VERSION} libpq-dev && \
    rm -rf /var/lib/apt/lists/*

RUN ln -sf /dev/stdout /var/log/nginx/access.log
RUN ln -sf /dev/stderr /var/log/nginx/error.log

# install phpredis extension
ENV PHPREDIS_VERSION 2.2.7

RUN curl -L -o /tmp/redis.tar.gz https://github.com/phpredis/phpredis/archive/$PHPREDIS_VERSION.tar.gz \
    && tar xfz /tmp/redis.tar.gz \
    && rm -r /tmp/redis.tar.gz \
    && mv phpredis-$PHPREDIS_VERSION /usr/src/php/ext/redis \
    && docker-php-ext-install redis pdo_pgsql pgsql opcache



#RUN export DEBIAN_FRONTEND=noninteractive \
#  && echo 'force-unsafe-io' > /etc/dpkg/dpkg.cfg.d/02apt-speedup \
#  && apt-get update \
#  && apt-get install --yes --no-install-recommends beanstalkd \
#  && rm -rf /var/lib/apt/lists/*

VOLUME /data
EXPOSE 11300

#ENTRYPOINT ["beanstalkd", "-p", "11300"]
#CMD ["-b", "/data"]

# Run nginx
EXPOSE 80 443
CMD /usr/local/sbin/php-fpm -D && /usr/sbin/nginx -g 'daemon off;'
