<?php
class BaseSql extends QueryConstructorSql {

	protected $table;
	protected $objectName;
	protected $db;
	protected $columns;

	public function __construct($table = null) {
		QueryConstructorSql::__construct();
		$this->table = (isset($table)) ? $table : strtolower(get_called_class());
		$this->objectName = get_called_class();
		try {
			$this->db=new PDO("mysql:host=".DBHOST.";dbname=".DBNAME,DBUSER,DBPWD, [PDO::ATTR_PERSISTENT => true]);
		} catch(Exception $e) {
			if (INSTALLATION_DONE) {
				echo "The server has a problem. It will be available soon";
				exit;
			}
		}
	}

	public function createDatabase($fileContent) {
		if (!isset($this->db))
			return FALSE;
		$query = $this->db->prepare($fileContent);
		return $query->execute();
	}

	public function insert($table = null) {
		try {
			$this->columns = ClassUtils::removeUnsusedColumns($this, get_class_vars(get_class()));
			$queryString = $this->constructInsertQuery($this->table, $this->columns);
			$query = $this->db->prepare($queryString);
			$query->execute($this->columns);
			return $this->db->lastInsertId();
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

	public function countItems($counter = "id") {
		$this->columns = ClassUtils::removeUnsusedColumns($this, get_class_vars(get_class()));
		$queryString = $this->constructCountQuery($this->table, $counter, $this->columns);
		$query = $this->db->prepare($queryString);
		$query->execute($this->columns);
		$response = $query->fetchAll();
		return ($counter == "id") ? ClassUtils::safeGetArrayIndex($response, [0, 'itemsNumber']) : $response;
	}

	public function getAll($data) {
		$orderBy = (isset($data) && isset($data['orderBy'])) ? $data['orderBy'] : null;
		$limit = (isset($data) && isset($data['limit'])) ? $data['limit'] : null;
		$queryString = $this->constructSelectQuery($this->table, null, FALSE, $orderBy, $limit);
		$query = $this->db->prepare($queryString);
		$query->execute();
		$response = $query->fetchAll();
		$objectList = $this->createObjectsListFromDBResponse($response);
		return $objectList;
	}

	public function getWithParameters($data) {
		$orderBy = (isset($data) && isset($data['orderBy'])) ? $data['orderBy'] : null;
		$limit = (isset($data) && isset($data['limit'])) ? $data['limit'] : null;
		$this->columns = ClassUtils::removeUnsusedColumns($this, get_class_vars(get_class()));
		$queryString = $this->constructSelectQuery($this->table, $this->columns, FALSE, $orderBy, $limit);
		$query = $this->db->prepare($queryString);
		$query->execute($this->columns);
		$response = $query->fetchAll();
		$objectList = $this->createObjectsListFromDBResponse($response);
		return $objectList;
	}

	public function getById() {
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
		$orderBy = (isset($data) && isset($data['orderBy'])) ? $data['orderBy'] : null;
		$limit = (isset($data) && isset($data['limit'])) ? $data['limit'] : null;
		$queryString = $this->constructSelectQuery($this->table, $columnsToSearch, TRUE, $orderBy, $limit);
		$query = $this->db->prepare($queryString);
		$this->setKeyword($query, $keyword);
		$query->execute();
		$response = $query->fetchAll();
		$objects = $this->createObjectsListFromDBResponse($response);
		return $objects;
	}

	public function getStatisticViewsHistory() {
		$queryString = $this->constructSelectStatisticsQuery();
		$query = $this->db->prepare($queryString);
		$query->execute();
		$response = $query->fetchAll();
		return $this->createObjectsListFromDBResponse($response);
	}

	private function createObjectsListFromDBResponse($response) {
		$objectList = array();
		foreach ($response as $key => $values) {
			$object = ClassUtils::constructObjectWithParameters($values, $this->objectName);
			if ($foreignKeyColumns = ClassUtils::getForeignKeyColumns($object)) {
				$this->setForeingObjectsColumns($object, $foreignKeyColumns);
			}
			if ($this->table == "comment") {
				if ($arrayColumns = ClassUtils::getIfExistArrayFromObject($object)) {
					ClassUtils::setReferencedObjectsColumns([substr(key($arrayColumns), 0, -1)], $object);
				}
			}
			array_push($objectList, $object);
		}
		return $objectList;
	}

	private function setForeingObjectsColumns(&$object, $foreignKeyColumns) {
		foreach ($foreignKeyColumns as $key => $value) {
			if (!isset($value))
				continue;
			$objectName = ucfirst(str_replace("_id", "", $key));
			$setter = "set" . $objectName;
			if (method_exists($object, $setter)) {
				$foreignObject = ClassUtils::constructObjectWithId($value, $objectName);
				$foreignObject = $foreignObject->getById();
				if ($objectName == USER_CLASS_NAME) {
					$this->setUserPublicInfos($foreignObject);
				}
				$object->$setter($foreignObject);
			}
		}
	}

	private function setUserPublicInfos(&$foreignObject) {
		$tempObject = new User();
		$tempObject->setId($foreignObject->getId());
		$tempObject->setUserName($foreignObject->getUsername());
		$tempObject->setAvatar($foreignObject->getAvatar());
		$tempObject->setEmail($foreignObject->getEmail());
		$foreignObject = $tempObject;
	}

	protected function hasResult($query) {
		return $response = $query->fetch();
	}

	protected function setKeyword(&$query, $keyword) {
		$keyword = "%".$keyword."%";
		$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
	}
}
