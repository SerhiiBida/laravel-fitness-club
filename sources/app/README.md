Инструкция использования:
docker compose build — собрать проект
docker compose up -d — запустить проект
docker compose down — остановить проект
docker compose logs -f [service name] — посмотреть логи сервиса
docker compose ps — вывести список контейнеров
docker compose exec [service name] [command» — выполнить команду в контейнере
docker compose images — список образов
docker exec -it [your_project_php_1] sh - зайти внутрь контейнера
docker compose down -v - удалить все сети и тома(volumes, даже БД)

Особенности:
composer dump-autoload - запуск внутри контейнера php для обновления namespace

Запуск сервера:
docker compose up -d
docker exec -it laravel-fitness-club-app-1 sh
php artisan serve

Создание enum для поля таблицы(Laravel 11):
php artisan make:enum TrainingStatus

Создание модели и миграции:
php artisan make:model User -m

Запуск миграций:
php artisan migrate

Откат последней миграции:
php artisan migrate:rollback

Откат всех миграций:
php artisan migrate:reset

Создание контроллера:
php artisan make:controller UserController

Создание ресурсного контроллера для API:
php artisan make:controller UserController --api

Создание класса для валидации:
php artisan make:request AuthRequest

Создать factory для шаблона генерации данных:
php artisan make:factory PostFactory

Создать seeder:
php artisan make:seeder UserSeeder

Запуск всех сеялок, для генерации данных в БД:
php artisan db:seed

Запуск определенной сеялки:
php artisan db:seed --class=UserSeeder

Запуск всех сеялок с удалением таблиц и запускам миграций повторно:
php artisan migrate:fresh --seed

Очистка кэша, если ошибки:
php artisan route:clear
php artisan config:clear
php artisan cache:clear
composer dump-autoload
