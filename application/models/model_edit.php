<?php


class Model_Edit extends Model
{

		/**
	 * Получение задачи по id.
	 *
	 * @param   int  $page  ID задачи
	 *
	 * @return array
	 */
	public function db_task_id($page)
	{
		$sql        = "SELECT * FROM tasks WHERE id = ?";
		$db_task_id = $this->db_fetch_data($sql, [$page]);

		return $db_task_id;
	}

		/**
	 * Изменение данных задачи.
	 *
	 * @param   string  $page        ID пользователя
	 * @param   string  $names_edit  Имя поля в БД
	 * @param   string  $name_date   Новое данные
	 *
	 * @return array
	 */
	public function db_edit($page, $names_edit, $name_date)
	{
		$sql  = "UPDATE tasks SET $names_edit = '$name_date' WHERE id=?";
		$task = $this->db_fetch_data($sql, [$page]);

		return $task;
	}
}
