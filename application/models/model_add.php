<?php


class Model_Add extends Model
{
		/**
	 * Добавление новой задачи.
	 *
	 * @param   string  $sql   SQL запрос с плейсхолдерами вместо значений
	 * @param   array   $data  Данные для вставки на место плейсхолдеров
	 *
	 * @return boolean
	 */

	function db_insert($data)
	{
		$link = $this->db_link();
		$sql = "INSERT INTO tasks (name, email, content) 
				VALUES (?, ?, ?)";
		//Получение записей с таблиц в MySQL.
		$stmt   = $this->db_get_prepare_stmt($link, $sql, $data);
		$result = mysqli_stmt_execute($stmt);

		return $result;
	}
}
