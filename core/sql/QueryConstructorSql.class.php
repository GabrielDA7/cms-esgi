<?php
class QueryConstructorSql {

	public function __construct() {}

	protected function constructSelectQuery($table, $columns = null, $like = FALSE, $orderBy = null, $limit = null) {
		$query = "SELECT *";
		$query .= " FROM " . $table;
		if (isset($columns)) {
			if (!$like) {
				$query .= " WHERE " . FormatUtils::formatMapToStringWithSeparators($columns, "", EQUAL.TWO_POINTS, " AND ", FALSE, TRUE);
			} else {
				$query .= " WHERE " . implode(" LIKE :keyword OR ", array_values($columns)) . " LIKE :keyword";
			}
		}
		if (isset($orderBy)) {
			$query .= " ORDER BY " . FormatUtils::formatMapToStringWithSeparators($orderBy, "", SPACE, COMMA);
		}
		if (isset($limit)) {
			$query .= " LIMIT " . implode(COMMA, $limit);
		}
		return $query;
	}

	protected function constructUpdateQuery($table, $columns) {
		unset($columns['id']);
		$query = "UPDATE " . $table;
		$query .= " SET " . FormatUtils::formatMapToStringWithSeparators($columns, "", EQUAL.TWO_POINTS, COMMA, FALSE, TRUE);
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
}
?>