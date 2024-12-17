### Инструкция использования Docker и Laravel:

``` docker compose build ```— собрать проект

``` docker compose up -d ```— запустить проект

``` docker compose down ```— остановить проект

``` docker compose logs -f [service name] ```— посмотреть логи сервиса

``` docker compose ps ```— вывести список контейнеров

``` docker compose images ```— список образов

``` docker exec -it [your_project_php_1] sh ```- зайти внутрь контейнера

``` docker compose down -v ```- удалить все сети и тома(volumes, даже БД)

Особенность - запуск внутри контейнера php для обновления namespace

```sh
composer dump-autoload
```

Запуск сервера Laravel:

```sh
docker compose up -d
docker exec -it laravel-fitness-club-app-1 sh
php artisan serve
php artisan queue:work
php artisan reverb:start --debug
```

Запуск Node:

```sh
npm install
npm run dev
```

Создание enum для поля таблицы(Laravel 11):

```sh
php artisan make:enum TrainingStatus
```

Создание модели и миграции:

```sh
php artisan make:model User -m
```

Запуск миграций:

```sh
php artisan migrate
```

Откат последней миграции:

```sh
php artisan migrate:rollback
```

Откат всех миграций:

```sh
php artisan migrate:reset
```

Создание контроллера:

```sh
php artisan make:controller UserController
```

Создание ресурсного контроллера для API:

```sh
php artisan make:controller UserController --api
```

Создание класса для валидации:

```sh
php artisan make:request AuthRequest
```

Создать factory для шаблона генерации данных:

```sh
php artisan make:factory PostFactory
```

Создать seeder:

```sh
php artisan make:seeder UserSeeder
```

Запуск всех сеялок, для генерации данных в БД:

```sh
php artisan db:seed
```

Запуск определенной сеялки:

```sh
php artisan db:seed --class=UserSeeder
```

Запуск всех сеялок с удалением таблиц и запускам миграций повторно:

```sh
php artisan migrate:fresh --seed
```

Запуск очередей:

```sh
php artisan queue:work
```

Запуска Reverb сервера для WebSocket

```sh
php artisan reverb:start --debug

# Перезапуск
php artisan reverb:restart
```

Очистка кэша, если ошибки:

```sh
php artisan route:clear
php artisan config:clear
php artisan cache:clear
composer dump-autoload
```
