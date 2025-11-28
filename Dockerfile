# Sử dụng PHP 8.2
FROM php:8.2-cli

# Cài đặt các công cụ cần thiết
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql zip

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Thiết lập thư mục làm việc
WORKDIR /app

# Copy toàn bộ code vào
COPY . .

# Cài thư viện Laravel
RUN composer install --no-dev --optimize-autoloader

# Lệnh chạy web (sử dụng cổng PORT do Render cấp)
CMD php artisan serve --host=0.0.0.0 --port=$PORT
