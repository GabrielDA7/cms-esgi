<?php

class BaseSql {

	protected $table;
	protected $db;
	protected $columns;	

	public function __construct() {
		$this->table = get_called_class();
		try {
			$this->db=new PDO("mysql:host=".DBHOST.";dbname=".DBNAME,DBUSER,DBPWD);
		} catch(Exception $e) {
			die("Erreur SQL ".$e->getMessage());
		}
	}

	public function setColumns() {
		$columnsExclude=get_class_vars(get_class());
		$this->columns=array_diff_key(get_object_vars($this), $columnsExclude);
	}
	
	public function save() {
		$this->setColumns();
		if ($this->getId()) {
			$query = $this->db->prepare("UPDATE ".$this->table." SET ".implode("=:", array_keys($this->columns)));
			$query->execute($this->columns);
		} else {
			unset($this->columns['id']);
			$query = $this->db->prepare("INSERT INTO ".$this->table."(".implode(',', array_keys($this->columns)).")
				VALUES (:".implode(',:', array_keys($this->columns)).")");
			$query->execute($this->columns);
		}
	}

	public function delete() {
		$query = $this->db->prepare("DELETE FROM ".$this->table." WHERE id=:id");
		$query->execute(array(":id" => $this->getId()));
	}

	public function getAll() {
		$query = $this->db->prepare("SELECT * FROM ".$this->table);
		$query->execute();
		$response = $query->fetchAll();
		$objectList = $this->getObjectsListFromDBResponse($response);
		return $objectList;
	}

	private function getObjectsListFromDBResponse($response) {
		$objectList = array();
		foreach ($response as $key => $value) {
			$object = new $this->table();
			foreach ($value as $keyValue => $valueValue) {
				if (!is_numeric($keyValue)) {
					$setter = 'set'.ucfirst($keyValue);
					$object->$setter($valueValue);
				}
			}
			array_push($objectList, $object);
		}
		return $objectList;
	}
}