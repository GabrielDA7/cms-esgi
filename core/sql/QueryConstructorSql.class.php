<?php
class QueryConstructorSql {

	public function __construct() {}

	protected function constructSelectQuery($table, $columns = null, $like = FALSE, $orderBy = null, $limit = null, $username = FALSE) {
		$query = "SELECT DISTINCT " . $table . ".* ";
		$query .= $this->computeFrom($table, $username);
		$query .= $this->computeWhere($table, $columns, $like, $username);
		if (isset($orderBy))
			$query .= " ORDER BY " . FormatUtils::formatMapToStringWithSeparators($orderBy, "", SPACE, COMMA);
		if (isset($limit))
			$query .= " LIMIT " . implode(COMMA, $limit);
		return $query;
	}



	protected function constructCountQuery($table, $counter, $columns, $like = FALSE, $username = FALSE) {
		$query = "SELECT count(" . $counter . ") as itemsNumber ";
		if ($counter != "id")
			$query .= COMMA . $counter . " as id";
		$query .= $this->computeFrom($table, $username);
		$query .= $this->computeWhere($table, $columns, $like, $username);
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

	protected function constructSelectStatisticsQuery() {
		$tables = ["viewed_trainning", "viewed_chapter", "viewed_video"];
		$query = "SELECT COUNT(DISTINCT ip) as views, dateInserted FROM (";
		foreach ($tables as $table) {
			$query .= "SELECT ip, date(dateInserted) as dateInserted FROM " . $table . " ";
			$query .= "WHERE dateInserted BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND CURDATE()";
			if ($table != end($tables))
				$query .= " union all ";
		}
		$query .= ") t GROUP BY dateInserted";
		return $query;
	}

	private function computeFrom($table, $username) {
		return " FROM " . $table . (($username) ? ", user" : "");
	}

	private function computeWhere($table, $columns = null, $like = FALSE, $username = FALSE) {
		$query = "";
		if (isset($columns) && !empty($columns)) {
			$onlyPublishedContent = $this->isOnlyPublishedContent($columns, $table);
			$query .= " WHERE ";

			if ($onlyPublishedContent) 
				$query .= "(";

			if (!$like) {
				$query .= FormatUtils::formatMapToStringWithSeparators($columns, $table.DOT, EQUAL.TWO_POINTS, " AND ", FALSE, TRUE);
			} else {
				$query .= FormatUtils::formatMapToStringWithSeparators($columns, $table.DOT, "", " LIKE :keyword OR ", TRUE, FALSE, FALSE);
				$query .= " LIKE :keyword";
			}
			if ($onlyPublishedContent) 
				$query .= ") AND status=1";
			
			if ($username) 
				$query .= " OR (user.id=" . $table . ".user_id AND user.username LIKE :keyword)";
			
		}
		return $query;
	}

	private function isOnlyPublishedContent(&$columns, $table) {
		if ($key = array_search("status", $columns) && $table != "user") {
			unset($columns[$key]);
			return TRUE;
		}
		return FALSE;
	}
}