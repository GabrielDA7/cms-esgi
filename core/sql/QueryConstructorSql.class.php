<?php
class QueryConstructorSql {

	public function __construct() {}

	protected function constructSelectQuery($table, $columns = null, $like = FALSE, $orderBy = null, $limit = null, $username = FALSE) {
		$query = "SELECT DISTINCT " . $table . ".* FROM " . $table;
		if ($username)
			$query .= ", user";
		if (isset($columns)) {
			if (!$like) {
				$query .= " WHERE " . FormatUtils::formatMapToStringWithSeparators($columns, $table.DOT, EQUAL.TWO_POINTS, " AND ", FALSE, TRUE);
			} else {
				$query .= " WHERE " . FormatUtils::formatMapToStringWithSeparators($columns, $table.DOT, "", " LIKE :keyword OR ", TRUE, FALSE, FALSE);
				$query .= " LIKE :keyword";
			}
			if ($username) {
				$query .= " OR (user.id=" . $table . ".user_id AND user.username LIKE :keyword)";
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

	protected function constructCountQuery($table, $counter) {
		$query = "SELECT count(" . $counter . ") as itemsNumber";
		if ($counter != "id")
			$query .= COMMA . $counter . " as id";
		$query .= " FROM " . $table;
		if ($counter != "id")
			$query .= " GROUP BY " . $counter . " ORDER BY itemsNumber DESC LIMIT 3";
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
		$query .= " VALUES(:" . implode(',:', array_keys($this->columns)) . ")";
		return $query;
	}

	protected function constructDeleteQuery($table) {
		$query = "DELETE FROM " . $table . " WHERE id=:id";
		return $query;
	}

	protected function constructSelectStatisticsQuery($date) {
		return "SELECT * FROM statistic WHERE date(dateInserted) = " . $date;
	}
}