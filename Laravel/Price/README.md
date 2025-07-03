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

С параметром USD:
GET /api/prices?currency=USD
Ответ:

[
  {"id":1, "title":"Товар 1", "price":"$1.11"},
  {"id":2, "title":"Товар 2", "price":"$0.56"}
]

С параметром EUR:
GET /api/prices?currency=EUR
Ответ:
[
  {"id":1, "title":"Товар 1", "price":"€1.00"},
  {"id":2, "title":"Товар 2", "price":"€0.50"}
]

Особенности реализации:
Хранение цен: Цены хранятся в копейках/центах (целые числа) для избежания ошибок округления.

Конвертация: Используются фиксированные курсы:

1 USD = 90 RUB (9000 копеек)

1 EUR = 100 RUB (10000 копеек)

Форматирование:

RUB: Разделение тысяч пробелами (1 000 ₽).

USD/EUR: Всегда 2 знака после запятой ($1.50).

Валидация валюты: Автоматическое приведение к верхнему регистру и проверка допустимых значений.

Данное решение соответствует требованиям Laravel 8+ и использует Eloquent Resource для форматирования вывода.
