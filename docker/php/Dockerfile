FROM php:8.2-fpm

# Устанавливаем необходимые пакеты, включая Supervisor и Cron
RUN apt-get update && apt-get install -y \
    cron \
    supervisor \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_pgsql zip

# Создаем нового пользователя
RUN useradd -m laravel

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

## Копируем файл конфигурации Supervisor
#COPY ./docker/supervisor/supervisord.conf /etc/supervisor/supervisord.conf
#
## Копируем файл cron
#COPY ./docker/php/cronjobs /etc/cron.d/laravel-cron
#
## Настраиваем права для cron файла
#RUN chmod 0644 /etc/cron.d/laravel-cron
#
## Регистрируем cron задание
#RUN crontab /etc/cron.d/laravel-cron
#
## Создаем файл cron лога и устанавливаем права для PID файла
#RUN touch /var/log/cron.log /var/log/supervisord.log
#RUN chown -R laravel:laravel /var/www/html /var/log/cron.log /var/log/supervisord.log /etc/cron.d /var/run
#RUN chmod -R 777 /var/run

# Указываем рабочую директорию
WORKDIR /var/www/html

# Запускаем cron, supervisor и php-fpm
CMD ["sh", "-c", "cron && supervisord -c /etc/supervisor/supervisord.conf && php-fpm"]
