<?php


class Model
{

	/**
	 * Подключение к БД.
	 *
	 * @return mysqli Ресурс соединения
	 */
	public function db_link()
	{
		$link = mysqli_connect('localhost', 'root', '', 'taskBook');
		mysqli_set_charset($link, "utf8");

		return $link;
	}
	
	/**
	 * Создает подготовленное выражение на основе готового SQL запроса и переданных данных.
	 *
	 * @param   mysqli  $link  Ресурс соединения
	 * @param   string  $sql   SQL запрос с плейсхолдерами вместо значений
	 * @param   array   $data  Данные для вставки на место плейсхолдеров
	 *
	 * @return mysqli_stmt Подготовленное выражение
	 */
	public function db_get_prepare_stmt($link, $sql, $data = [])
	{
		$stmt = mysqli_prepare($link, $sql);
		if ($stmt === false) {
			$errorMsg = 'Не удалось инициализировать подготовленное выражение: ' . mysqli_error($link);
			die($errorMsg);
		}
		if ($data) {
			$types     = '';
			$stmt_data = [];
			foreach ($data as $value) {
				$type = 's';
				if (is_int($value)) {
					$type = 'i';
				} else {
					if (is_string($value)) {
						$type = 's';
					} else {
						if (is_double($value)) {
							$type = 'd';
						}
					}
				}
				if ($type) {
					$types       .= $type;
					$stmt_data[] = $value;
				}
			}
			$values = array_merge([$stmt, $types], $stmt_data);
			$func   = 'mysqli_stmt_bind_param';
			$func(...$values);
			if (mysqli_errno($link) > 0) {
				$errorMsg = 'Не удалось связать подготовленное выражение с параметрами: ' . mysqli_error($link);
				die($errorMsg);
			}
		}

		return $stmt;
	}

	 /**
	 * Получение записей с таблиц в MySQL.
	 *
	 * @param string $sql  SQL запрос с плейсхолдерами вместо значений
	 * @param array  $data Данные для вставки на место плейсхолдеров
	 *
	 * @return array
	 */
	public function db_fetch_data($sql, $data = [])
	{
		$link = $this->db_link();
		$result = [];
		$stmt   = $this->db_get_prepare_stmt($link, $sql, $data);
		mysqli_stmt_execute($stmt);
		$res = mysqli_stmt_get_result($stmt);
		if ($res) {
			$result = mysqli_fetch_all($res, MYSQLI_ASSOC);
		}

		return $result;
	}
}
