<?php
class QueryConstructorSql {

	public function __construct() {}

	protected function constructSelectQuery($table, $select = ALL, $columns = null, $orderBy = null, $limit = null) {
		$query = "SELECT " . $select;
		$query .= " FROM " . $table;
		if (isset($columns)) {
			$query .= " WHERE " . $this->createSeparatorBetweenKeyValues($columns, "", EQUAL.TWO_POINTS, " AND ", FALSE, TRUE);
		}
		if (isset($orderBy)) {
			$query .= " ORDER BY " . $this->createSeparatorBetweenKeyValues($orderBy, "", SPACE, DOT);
		}
		if (isset($limt)) {
			$query .= " LIMIT " . $limit;
		}
		return $query;
	}

	protected function constructUpdateQuery($table, $columns) {
		unset($columns['id']);
		$query = "UPDATE " . $table;
		$query .= " SET " . $this->createSeparatorBetweenKeyValues($columns, "", EQUAL.TWO_POINTS, COMMA, FALSE, TRUE);
		$query .= " WHERE " . $this->createSeparatorBetweenKeyValues(array("id" => "id"), "", EQUAL.TWO_POINTS, "");
		return $query;
	}

	protected function constructInsertQuery($table, $columns) {
		$query = "INSERT INTO " . $table . "(" . $this->createSeparatorBetweenKeyValues($columns, "", COMMA, "", FALSE) . ")";
		$query .= " VALUES(" . $this->createSeparatorBetweenKeyValues($columns, TWO_POINTS, COMMA, "", FALSE) . ")";
		return $query;
	}

	protected function constructDeleteQuery($table) {
		$query = "DELETE FROM " . $this->table;
		$query .= " WHERE " . $this->createSeparatorBetweenKeyValues(array("id" => "id"), "", EQUAL.TWO_POINTS, "");
		return $query;
	}

	/* Pour plusieurs tables voir comment faire pour ajour la premiere lettre
	*  de la table et . devant la cle du where (savoir a quelle table appartient cette cle) */
	/*private function setWhereValuesWithTableName($objectList) {

	}*/

	private function createSeparatorBetweenKeyValues($array, $separatorBefore, $separatorBetween, $separatorAfter, $flagValue = TRUE, $doubleKey = FALSE) {
		$numberOfItems = count($array);
		$i = 0;
		$separedValues = "";
		foreach ($array as $key => $value) {
			$value = ($flagValue)? $value : "";
			$value = ($doubleKey)? $key : $value;
			if (!(++$i === $numberOfItems)) {
				$separedValues .= $separatorBefore . $key . $separatorBetween . $value . $separatorAfter;
	  		} else if ($value != "") {
	  			$separedValues .= $separatorBefore . $key . $separatorBetween . $value;
	  		} else {
	  			$separedValues .= $separatorBefore . $key;
	  		}
		}
		return $separedValues;
	}

}
?>