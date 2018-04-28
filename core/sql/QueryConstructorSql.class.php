<?php
class QueryConstructorSql {

	public function __construct() {}

	protected function constructSelectQuery($table, $columns = null, $like = FALSE, $orderBy = null, $limit = null) {
		$query = "SELECT *";
		$query .= " FROM " . $table;
		if (isset($columns)) {
			if (!$like) {
				$query .= " WHERE " . $this->formatConditionQuery($columns, "", EQUAL.TWO_POINTS, " AND ", FALSE, TRUE);
			} else {
				$query .= " WHERE " . implode(" LIKE :keyword OR ", array_values($columns)) . " LIKE :keyword";
			}
		}
		if (isset($orderBy)) {
			$query .= " ORDER BY " . $this->formatConditionQuery($orderBy, "", SPACE, COMMA);
		}
		if (isset($limt)) {
			$query .= " LIMIT " . $limit;
		}
		return $query;
	}

	protected function constructUpdateQuery($table, $columns) {
		unset($columns['id']);
		$query = "UPDATE " . $table;
		$query .= " SET " . $this->formatConditionQuery($columns, "", EQUAL.TWO_POINTS, COMMA, FALSE, TRUE);
		$query .= " WHERE id=:id";
		return $query;
	}

	protected function constructInsertQuery($table, $columns) {
		$query = "INSERT INTO " . $table . "(" . implode(',', array_keys($this->columns)) . ")";
		$query .= " VALUES(" . implode(',:', array_keys($this->columns)) . ")";
		return $query;
	}

	protected function constructDeleteQuery($table) {
		$query = "DELETE FROM " . $table . " WHERE id=:id";
		return $query;
	}

	/* Pour plusieurs tables voir comment faire pour ajour la premiere lettre
	*  de la table et . devant la cle du where (savoir a quelle table appartient cette cle) */
	private function setWhereValuesWithTableName($objectList) {

	}

	private function formatConditionQuery($array, $separatorBefore, $separatorBetween, $separatorAfter, $flagValue = TRUE, $doubleKey = FALSE) {
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