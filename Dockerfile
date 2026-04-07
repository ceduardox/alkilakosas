FROM php:8.2-apache

RUN apt-get update \
	&& apt-get install -y --no-install-recommends \
		libfreetype6-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
		libwebp-dev \
		libzip-dev \
		libicu-dev \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
	&& docker-php-ext-install -j"$(nproc)" gd mysqli zip exif intl opcache \
	&& a2dismod mpm_event mpm_worker || true \
	&& a2enmod mpm_prefork rewrite headers \
	&& rm -rf /var/lib/apt/lists/*

COPY docker/apache-wordpress.conf /etc/apache2/conf-available/wordpress.conf
RUN a2enconf wordpress

COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html/wp-content

COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENV PORT=8080
EXPOSE 8080
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
