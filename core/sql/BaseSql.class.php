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
			RedirectUtils::redirect404();
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
			return null;
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

	public function countItems() {
		$queryString = $this->constructCountQuery($this->table);
		$query = $this->db->prepare($queryString);
		$query->execute();
		$response = $query->fetch();
		return $response['itemsNumber'];
	}

	public function getAll($data) {
		$orderBy = (isset($data['orderBy'])) ? $data['orderBy'] : null;
		$limit = (isset($data['limit'])) ? $data['limit'] : null;
		$queryString = $this->constructSelectQuery($this->table, null, FALSE, $orderBy, $limit);
		$query = $this->db->prepare($queryString);
		$query->execute();
		$response = $query->fetchAll();
		$objectList = $this->createObjectsListFromDBResponse($response);
		return $objectList;
	}

	public function getWithParameters() {
		$this->columns = ClassUtils::removeUnsusedColumns($this, get_class_vars(get_class()));
		$queryString = $this->constructSelectQuery($this->table, $this->columns);
		$query = $this->db->prepare($queryString);
		$query->execute($this->columns);
		$response = $query->fetchAll();
		$objectList = $this->createObjectsListFromDBResponse($response);
		return $objectList;
	}

	public function getById($id = null) {
		$this->columns = ClassUtils::removeUnsusedColumns($this, get_class_vars(get_class()));
		$queryString = $this->constructSelectQuery($this->table, $this->columns);
		$query = $this->db->prepare($queryString);
		$query->execute($this->columns);
		$response = $query->fetch();
		$object = ClassUtils::constructObjectWithParameters($response, $this->table);
		if ($foreignKeyColumns = ClassUtils::getForeignKeyColumns($object)) {
			$this->setForeingObjectsColumns($object, $foreignKeyColumns);
		}
		return $object;
	}

	public function getByWord($keyword, $columnsToSearch, $data) {
		$orderBy = (isset($data['orderBy'])) ? $data['orderBy'] : null;
		$limit = (isset($data['limit'])) ? $data['limit'] : null;
		$queryString = $this->constructSelectQuery($this->table, $columnsToSearch, TRUE, $orderBy, $limit);
		$query = $this->db->prepare($queryString);
		$this->setKeyword($query, $keyword);
		$query->execute();
		$response = $query->fetchAll();
		$objects = $this->createObjectsListFromDBResponse($response);
		return $objects;
	}


	private function createObjectsListFromDBResponse($response) {
		$objectList = array();
		foreach ($response as $key => $values) {
			$object = ClassUtils::constructObjectWithParameters($values, $this->table);
			if ($foreignKeyColumns = ClassUtils::getForeignKeyColumns($object)) {
				$this->setForeingObjectsColumns($object, $foreignKeyColumns);
			}
			array_push($objectList, $object);
		}
		return $objectList;
	}

	private function setForeingObjectsColumns(&$object, $foreignKeyColumns) {
		foreach ($foreignKeyColumns as $key => $value) {
			$objectName = ucfirst(str_replace("_id", "", $key));
			$setter = "set" . $objectName;
			if (method_exists($object, $setter)) {	
				$foreignObject = ClassUtils::constructObjectWithId($value, $objectName);
				$foreignObject = $foreignObject->getById();
				if ($objectName == USER_CLASS_NAME) {
					$tempObject = new User();
					$tempObject->setUserName($foreignObject->getUsername());
					$foreignObject = $tempObject;
				}
				$object->$setter($foreignObject);
			}
		}
	}

	protected function hasResult($query) {
		return $response = $query->fetch();
	}

	protected function setKeyword(&$query, $keyword) {
		$keyword = "%".$keyword."%";
		$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
	}
}
