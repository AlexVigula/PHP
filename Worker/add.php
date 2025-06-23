use Pheanstalk\Pheanstalk;

// подключимся к очереди
$worker = new Pheanstalk('127.0.0.1');

// ...
// код сохранения изображений на сервер
foreach ($_FILES as $image) {
    $data = [
        'path' => $image['tmp_name'],
        'name' => $image['name'],
    ];

    // добавляем задачу на обработку изображения в очередь
    $pheanstalk
        ->useTube('images') //название выше созданной очереди images
        ->put(json_encode($data)); // полезные, данные, которые потребуются обработчику 
}
