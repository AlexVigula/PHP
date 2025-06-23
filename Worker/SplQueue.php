$queue = new SplQueue();

// Постановка задач в очередь
$queue->enqueue("Задача 1");
$queue->enqueue("Задача 2");
$queue->enqueue("Задача 3");

// Обработка задач из очереди
while (!$queue->isEmpty()) {
    $task = $queue->dequeue();
    echo "Обработка задачи: " . $task . "\n";
    // Здесь можно добавить код для выполнения задачи
}
