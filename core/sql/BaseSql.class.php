<?php
class BaseSql extends QueryConstructorSql {

	protected $table;
	protected $db;
	protected $columns;

	public function __construct() {
		QueryConstructorSql::__construct();
		$this->table = strtolower(get_called_class());
		try {
			$this->db=new PDO("mysql:host=".DBHOST.";dbname=".DBNAME,DBUSER,DBPWD);
		} catch(Exception $e) {
			return404View();
		}
	}

	public function createDatabase($fileContent) {
		$query = $this->db->prepare($fileContent);
		$query->execute();
	}

	public function insert() {
		try {
			$this->columns = ClassUtils::removeUnsusedColumns($this, get_class_vars(get_class()));
			$queryString = $this->constructInsertQuery($this->table, $this->columns);
			$query = $this->db->prepare($queryString);
			$query->execute($this->columns);
			return $this->getById($this->db->lastInsertId());
		} catch (Exception $e) {
			LogsUtils::process("logs", "Insert", "Error :" . $e->getMessage());
			return null;
		}
	}

	public function update() {
		$this->columns = ClassUtils::removeUnsusedColumns($this, get_class_vars(get_class()));
		$queryString = $this->constructUpdateQuery($this->table, $this->columns);
		$query = $this->db->prepare($queryString);
		$query->execute($this->columns);
	}

	public function delete() {
		$this->columns = ClassUtils::removeUnsusedColumns($this, get_class_vars(get_class()));
		$queryString = $this->constructDeleteQuery($this->table);
		$query = $this->db->prepare($queryString);
		$query->execute($this->columns);
	}

	public function getAll($toObject = TRUE) {
		$queryString = $this->constructSelectQuery($this->table);
		$query = $this->db->prepare($queryString);
		$query->execute();
		$response = $query->fetchAll();
		if ($toObject) {
			$objectList = $this->createObjectsListFromDBResponse($response);
			return $objectList;
		}
		return $response;
	}

	public function getWithParameters($toObject = TRUE) {
		$this->columns = ClassUtils::removeUnsusedColumns($this, get_class_vars(get_class()));
		$queryString = $this->constructSelectQuery($this->table, $this->columns);
		$query = $this->db->prepare($queryString);
		$query->execute($this->columns);
		$response = $query->fetchAll();
		if ($toObject) {
			$objectList = $this->createObjectsListFromDBResponse($response);
			return $objectList;
		}
		return $response;
	}

	public function getById() {
		$this->columns = ClassUtils::removeUnsusedColumns($this, get_class_vars(get_class()));
		$queryString = $this->constructSelectQuery($this->table, $this->columns);
		$query = $this->db->prepare($queryString);
		$query->execute($this->columns);
		$response = $query->fetch();
		$object = ClassUtils::constructObjectWithParameters($response, $this->table);
		return $object;
	}

	public function getByWord($keyword, $columnsToSearch) {
		$queryString = $this->constructSelectQuery($this->table, $columnsToSearch, TRUE);
		$query = $this->db->prepare($queryString);
		$this->setKeyword($query, $keyword);
		$query->execute();
		/*if ($toObject) {
			$objects = $this->createObjectsListFromDBResponse($response);
			return $objects;
		}*/
		return $query->fetchAll();
	}


	private function createObjectsListFromDBResponse($response) {
		$objectList = array();
		foreach ($response as $key => $values) {
			$object = ClassUtils::constructObjectWithParameters($values, $this->table);
			array_push($objectList, $object);
		}
		return $objectList;
	}

	protected function hasResult($query) {
		return $response = $query->fetch();
	}

	protected function setKeyword(&$query, $keyword) {
		$keyword = "%".$keyword."%";
		$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
	}
}
?>
