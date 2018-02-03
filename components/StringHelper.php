<?php

/**
 * Класс для работы с строками
 */

class StringHelper
{	
	/**
	 * Длина строки по умолчанию
	 */
	const MAX_LENGTH = 100;

	/**
	 * @param  string - $string входящая стркоа
	 * @param  integer - $maxLength нужная длина строки
	 * @return string - обрезаная строка
	 */
	public function getShortSymbolText($string, $maxLength = null)
	{
		if(mb_strlen($string) < self::MAX_LENGTH){
			return $string;
		}

		if($maxLength === null){
			$maxLength = self::MAX_LENGTH;			
		}
		$string = mb_substr($string, 0 , $maxLength);
		return $string."...";
	}
}