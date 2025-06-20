function get_minification_array($text)
{
	// Удаление экранированных спецсимволов
	$text = stripslashes($text);	
	
	// Преобразование мнемоник 
	$text = html_entity_decode($text);
	$text = htmlspecialchars_decode($text, ENT_QUOTES);	
	
	// Удаление html тегов
	$text = strip_tags($text);
	
	// Все в нижний регистр 
	$text = mb_strtolower($text);	
	
	// Удаление лишних символов
	$text = str_ireplace('ё', 'е', $text);
	$text = mb_eregi_replace("[^a-zа-яй0-9 ]", ' ', $text);
	
	// Удаление двойных пробелов
	$text = mb_ereg_replace('[ ]+', ' ', $text);
	
	// Преобразование текста в массив
	$words = explode(' ', $text);
	
	// Удаление дубликатов
	$words = array_unique($words);
 
	// Удаление предлогов и союзов
	$array = array(
		'без',  'близ',  'в',     'во',     'вместо', 'вне',   'для',    'до', 
		'за',   'и',     'из',    'изо',    'из',     'за',    'под',    'к',  
		'ко',   'кроме', 'между', 'на',     'над',    'о',     'об',     'обо',
		'от',   'ото',   'перед', 'передо', 'пред',   'предо', 'по',     'под',
		'подо', 'при',   'про',   'ради',   'с',      'со',    'сквозь', 'среди',
		'у',    'через', 'но',    'или',    'по'
	);
 
	$words = array_diff($words, $array);
 
	// Удаление пустых значений в массиве
	$words = array_diff($words, array(''));	
 
	return $words;
}
