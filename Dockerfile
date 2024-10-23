FROM php:8.3-fpm-alpine

WORKDIR /var/www

# Install required packages and PHP extensions
RUN apk update && apk add --no-cache \
    build-base \
    freetype-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    libzip-dev \
    zip \
    vim \
    unzip \
    git \
    jpegoptim \
    optipng \
    pngquant \
    gifsicle \
    curl \
    autoconf \
    && docker-php-ext-install pdo_mysql zip exif pcntl \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install gd \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apk del autoconf

# Copy local PHP configuration
COPY ./config/php/local.ini /usr/local/etc/php/conf.d/local.ini

# Create non-root user and group
RUN addgroup -g 655 -S www && \
    adduser -u 655 -S www -G www

# Copy existing application directory contents and set ownership
COPY --chown=www:www . /var/www

# Set permissions
RUN chown -R www:www /var/www/storage \
    && chmod -R 775 /var/www/storage \
    && chmod -R 775 storage bootstrap/cache \
    && chmod -R 755 ./

# Change to non-root user
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]