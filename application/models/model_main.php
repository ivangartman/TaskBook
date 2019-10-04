<?php


class Model_Main extends Model
{
    /**
     * Получение списка задач (сортировка по id).
     *
     * @param   string  $sql   SQL запрос с плейсхолдерами вместо значений
     *
     * @return array
     */
    public function db_tasks_id()
    {

        $sql         = "SELECT * FROM tasks ORDER BY id DESC";
        $db_tasks_id = $this->db_fetch_data($sql);
	
        return $db_tasks_id;
	}
	
	/**
	 * Получение списка задач + пагинация.
	 *
	 * @param   int     $offset      Смещение выборки
	 * @param   int     $page_items  Количество выводимых записей
	 * @param   int     $key         Поле по которому производится сортировка
	 * @param   int     $sort        Метод сортировки
	 *
	 * @return array
	 */
	public function db_task_id_page($page_items, $offset, $key, $sort)
	{
		$sql = "SELECT * FROM tasks
				ORDER BY $key $sort LIMIT $page_items OFFSET $offset";
		$db_task_id_page = $this->db_fetch_data($sql);

		return $db_task_id_page;
	}

		/**
	 * Получение задачи по id.
	 *
	 * @param   int     $page  ID задачи
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
	 * Удаление задачи по id.
	 *
	 * @param   int     $page  ID задачи
	 *
	 * @return array
	 */
	public function db_task_delete($page)
	{
		$sql            = "DELETE FROM tasks WHERE id=?";
		$db_task_delete = $this->db_fetch_data($sql, [$page]);

		return $db_task_delete;
	}
}
