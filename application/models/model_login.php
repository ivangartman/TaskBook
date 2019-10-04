<?php


class Model_Login extends Model
{

	 /**
	 * Получение переченя пользователей.
	 *
	 * @param   string  $first_name  Имя пользователя
	 *
	 * @return array
	 */
	public function db_user($first_name)
	{
		$link = $this->db_link();
		//Получение записей с таблиц в MySQL.
		$sql  = "SELECT * FROM users WHERE first_name = '$first_name'";
		$res  = mysqli_query($link, $sql);
		$user = $res ? mysqli_fetch_array($res, MYSQLI_ASSOC) : null;

		return $user;
	}
}
