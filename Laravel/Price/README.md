1. Создайте модель и миграцию для товара

php artisan make:model Product -m

Выполните миграцию:
php artisan migrate

2. Создайте ресурс для товара
php artisan make:resource ProductResource

3. Создайте контроллер для обработки запроса
php artisan make:controller PriceController

Реализуйте логику в контроллере (app/Http/Controllers/PriceController.php

4. Зарегистрируйте кастомный метод для коллекции ресурсов
Добавьте в AppServiceProvider (app/Providers/AppServiceProvider.php):

5. Добавьте маршрут в routes/api.php

use App\Http\Controllers\PriceController;

Route::get('/prices', [PriceController::class, 'index'])->name('api.prices');

6. Пример тестирования
Добавьте тестовые данные в базу (например, через DatabaseSeeder):

use App\Models\Product;

public function run()
{
    Product::create(['title' => 'Товар 1', 'price' => 10000]); // 100 рублей
    Product::create(['title' => 'Товар 2', 'price' => 5000]);  // 50 рублей
}

Проверка работы:
Без параметра (валюта по умолчанию RUB):
GET /api/prices
Ответ:
[
  {"id":1, "title":"Товар 1", "price":"100 ₽"},
  {"id":2, "title":"Товар 2", "price":"50 ₽"}
]


