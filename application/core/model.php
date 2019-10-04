<?php


class Model
{
    
	/*
		Модель обычно включает методы выборки данных, это могут быть:
			> методы нативных библиотек pgsql или mysql;
			> методы библиотек, реализующих абстракицю данных. Например, методы библиотеки PEAR MDB2;
			> методы ORM;
			> методы для работы с NoSQL;
			> и др.
	*/

	// метод выборки данных

	public function get_data()
	{
		// todo
	}

	 /**
	 * Получение записей с таблиц в MySQL.
	 *
	 * @param   string  $sql   SQL запрос с плейсхолдерами вместо значений
	 * @param   array   $data  Данные для вставки на место плейсхолдеров
	 *
	 * @return array
	 */
	public function db_fetch_data($sql, $data = [])
	{
		//Подключение БД
		$link = mysqli_connect('localhost', 'root', '', 'taskBook');
		mysqli_set_charset($link, "utf8");
		//Получение записей с таблиц в MySQL.
		$result = [];
		$stmt   = db_get_prepare_stmt($link, $sql, $data);
		mysqli_stmt_execute($stmt);
		$res = mysqli_stmt_get_result($stmt);
		if ($res) {
			$result = mysqli_fetch_all($res, MYSQLI_ASSOC);
		}

		return $result;
	}
}