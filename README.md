<p align="center"><img src="https://cdn.contactcenterworld.com/images/company/readme-1200px-logo.png" width="400"></p>

## About 

В проекте реализована возможность тестирования с использованием
фейковых данных. Для этого необходимо инициализировать создание БД и запуск сидера.
 
Порядок действий:

1. 
docker-compose up

2. 
docker-compose exec web bash

3. 
composer install (ждем пока установятся зависимости)

4. 
php artisan tinker --execute="(new PDO('mysql:host=' . env('DB_HOST'), env('DB_USERNAME'), env('DB_PASSWORD')))->exec('CREATE DATABASE ' . env('DB_DATABASE'))"
php artisan db:seed


