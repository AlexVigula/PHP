// Подключение к БД
$dbh = new PDO('mysql:dbname=db_name;host=localhost', 'логин', 'пароль');
 
// Получаем статью
$sth = $dbh->prepare("SELECT * FROM `articles` WHERE `id` = 1");
$sth->execute(array());
$article = $sth->fetch(PDO::FETCH_ASSOC);
 
// Получаем для неё массив слов
$text = get_minification_array($article['name'] . ' ' . $article['text']);
 
$count = count($text);	
$out = array();
 
// Проход по всем статьям в таблице
$sth = $dbh->prepare("SELECT * FROM `articles`");
$sth->execute();	
$list = $sth->fetchAll(PDO::FETCH_ASSOC);
 
foreach($list as $row) {
	$verifiable = get_minification_array($row['name'] . ' ' . $row['text']);
 
	$similar_counter = 0;
	foreach ($text as $text_row) {
		foreach ($verifiable as $verifiable_row){
			if($text_row == $verifiable_row) {
				$similar_counter++;
				break;
			}
		}
	}
	$out[$row['name']] = $similar_counter * 100 / $count;
}
 
// Сортировка результатов и ограничение до 15шт
arsort($out);
$out = array_slice($out, 0, 15, true);
 
print_r($out);
