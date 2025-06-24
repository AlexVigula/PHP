<?php
class Cache
{
	public static  $enable = true;
	public static  $path = '/cache';
	private static $keys = array();
 
	/**
	 * Получение данных из кэша.
	 */
	public static function get($name) 
	{
		if (self::$enable) {
			$file = __DIR__ . self::$path . '/' . $name . '.tmp';
			if (file_exists($file)) {
				return file_get_contents($file);
			} else {
				self::$keys[] = $name;
				return false;
			}				
		} else {
			return '';
		}
	}
 
	/**
	 * Отправка данных в кэш.
	 */
	public static function set($content) 
	{
		if (self::$enable) {
			$name = array_pop(self::$keys);
			$dir  = __DIR__ . self::$path . '/';
			if (!is_dir($dir)) {
				@mkdir($dir, 0777, true);
			}
			file_put_contents($dir . '/' . $name . '.tmp', $content);
		} 
 
		return $content;
	}
 
	/**
	 * Начало кэширования фрагмента.
	 */
	public static function begin($name) 
	{
		if ($content = self::get($name)) {
			echo $content;
			return false;
		} else {
			ob_start();
			return true;
		}
	}
	
	/**
	 * Завершение кэширования фрагмента.
	 */
	public static function end() 
	{
		echo self::set(ob_get_clean());
	}
	
	/**
	 * Очистка кэша.
	 */
	public static function clear() 
	{
		$dir = __DIR__ . self::$path;
		foreach (glob($dir . '/*') as $file) {
			if (is_file($file)) {
				unlink($file);
			}
		}
	}
}
