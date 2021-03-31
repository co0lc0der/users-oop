<?php

class Database
{
	private static $instance = null;
	private $pdo, $query, $error = false, $results, $count;

	private function __construct() {
		// try {
		//     $this->pdo = new PDO("mysql:host=" . Config::get('mysql.host') . ";dbname=" . Config::get('mysql.database'), Config::get('mysql.username'), Config::get('mysql.password'));
		// } catch (PDOException $exception) {
		//     die($exception->getMessage());
		// }
		try {
			if (Config::get('dbdriver') == 'sqlite') {
				$this->pdo = new PDO("sqlite:" . Config::get('sqlite.database'), '', '', [
					PDO::ATTR_EMULATE_PREPARES => false,
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
					PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
				]);
			} else if (Config::get('dbdriver') == 'mysql') {
				$this->pdo = new PDO("mysql:host=" . Config::get('mysql.host') . ";dbname=" . Config::get('mysql.database') . "; charset=utf8", Config::get('mysql.username'), Config::get('mysql.password'), [
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
					PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
				]);
			}
		} catch (PDOException $exception) {
			die($exception->getMessage());
		}
	}

	public static function getInstance() {
		if(!isset(self::$instance)) {
			self::$instance = new Database;
		}

		return self::$instance;
	}

	public function query($sql, $params = []) {
		$this->error = false;
		$this->query = $this->pdo->prepare($sql);

		if(count($params)) {
			$i = 1;
			foreach($params as $param) {
				$this->query->bindValue($i, $param);
				$i++;
			}
		}

		if(!$this->query->execute()) {
			$this->error = true;
		} else {
			$this->results = $this->query->fetchAll(PDO::FETCH_OBJ);
			$this->count = count($this->results);
		}

		return $this;
	}

	public function error()	{
		return $this->error;
	}

	public function results()	{
		//var_dump($this->results);
		return $this->results;
	}

	public function count()	{
		return $this->count;
	}

	public function get($table, $where = []) {
		return $this->action('SELECT *', $table, $where);
	}

	public function getAll($table) {
		return $this->action('SELECT *', $table, ['1']);
	}

	public function getFields($fields, $table, $where = []) {
		if (is_array($fields)) {
			return $this->action('SELECT `' . implode('`, `', $fields) . '`', $table, $where);
		} else if (is_string($fields)) {
			return $this->action("SELECT `{$fields}`", $table, $where);
		}
	}

	public function delete($table, $where = []) {
		return $this->action('DELETE', $table, $where);
	}

	public function action($action, $table, $where = []) {
		//var_dump($action);die;
		if(count($where) === 3) {

			$operators = ['=', '>', '<', '>=', '<='];

			$field = $where[0];
			$operator = $where[1];
			$value = $where[2];

			if(in_array($operator, $operators)) {

				$sql = "{$action} FROM `{$table}` WHERE `{$field}` {$operator} ?";
				//var_dump('3 - ' . $sql);
				if(!$this->query($sql, [$value])->error()) { //true если есть ошибка

					return $this;
				}
			}
		} else if (count($where) === 1) {
			$sql = "{$action} FROM `{$table}` WHERE {$where[0]}";
			//var_dump('1 - '.$sql);
			if(!$this->query($sql)->error()) { //true если есть ошибка
				return $this;
			}
		}

		return false;
	}

	public function insert($table, $fields = []) {
		$values = '';
		foreach($fields as $field) {
			$values .= "?,";
		}
		$val = rtrim($values, ',');

		$sql = "INSERT INTO `{$table}` (" . '`' . implode('`, `', array_keys($fields)) . '`' . ") VALUES ({$val})";

		if($this->query($sql, $fields)->error()) return false;

		return true;
	}

	public function update($table, $id, $fields = []) {
		$set = '';
		foreach($fields as $key => $field) {
			$set .= "`{$key}` = ?,"; // username = ?, password = ?,
		}

		$set = rtrim($set, ','); // username = ?, password = ?

		$sql = "UPDATE `{$table}` SET {$set} WHERE `id` = {$id}";

		if($this->query($sql, $fields)->error()) return false;

		return true;
	}

	public function first() {
		return $this->results()[0];
	}
}
