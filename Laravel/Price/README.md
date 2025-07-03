1. Создайте модель и миграцию для товара

php artisan make:model Product -m

Выполните миграцию:
php artisan migrate

2. Создайте ресурс для товара
php artisan make:resource ProductResource

3. Создайте контроллер для обработки запроса
php artisan make:controller PriceController
