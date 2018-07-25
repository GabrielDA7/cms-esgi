<?php
class QueryConstructorSql {

	public function __construct() {}

	protected function constructSelectQuery($table, $columns = null, $like = FALSE, $orderBy = null, $limit = null) {
		$searchUsername = FALSE;
		$searchTrainningTitle = FALSE;
		if (isset($columns)) {
			$searchUsername = in_array("user_id", $columns);
			$searchTrainningTitle = in_array("trainning_id", $columns);
		}
		$query = "SELECT DISTINCT " . $table . ".* ";
		$query .= $this->computeFrom($table, $searchUsername, $searchTrainningTitle, $like);
		$query .= $this->computeWhere($table, $columns, $like, $searchUsername, $searchTrainningTitle);
		if (isset($orderBy))
			$query .= " ORDER BY " . FormatUtils::formatMapToStringWithSeparators($orderBy, "", SPACE, COMMA);
		if (isset($limit))
			$query .= " LIMIT " . implode(COMMA, $limit);
		return $query;
	}



	protected function constructCountQuery($table, $counter, $columns, $like = FALSE) {
		if (isset($columns)) {
			$searchUsername = in_array("user_id", $columns);
			$searchTrainningTitle = in_array("trainning_id", $columns);
		}
		$query = "SELECT count(" . $counter . ") as itemsNumber ";
		if ($counter != "id")
			$query .= COMMA . $counter . " as id";
		$query .= $this->computeFrom($table, $searchUsername, $searchTrainningTitle, $like);
		$query .= $this->computeWhere($table, $columns, $like, $searchUsername, $searchTrainningTitle);
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
			if ($table != end($tables))
				$query .= " union all ";
		}
		$query .= ") t GROUP BY dateInserted ORDER BY dateInserted asc";
		return $query;
	}

	private function computeFrom($table, $searchUsername = FALSE, $searchTrainningTitle = FALSE, $like = FALSE) {
		$query = " FROM " . $table; 
		$query .= (($searchUsername && $like) ? ", user" : "");
		$query .= (($searchTrainningTitle && $like) ? ", trainning" : "");
		return $query;
	}

	private function computeWhere($table, $columns = null, $like = FALSE, $username = FALSE, $searchTrainningTitle = FALSE) {
		$query = "";
		if (isset($columns) && !empty($columns)) {
			$onlyPublishedContent = $this->isOnlyPublishedContent($columns, $table);
			$onlyNotPremiumContent = $this->isOnlyNotPremiumContent($columns, $table);
			$date = $this->getIfContainDate($columns);
			$query .= " WHERE ";
			if (!$like) {
				$query .= FormatUtils::formatMapToStringWithSeparators($columns, $table.DOT, EQUAL.TWO_POINTS, " AND ", FALSE, TRUE);
			} else {
				$query .= FormatUtils::formatMapToStringWithSeparators($columns, $table.DOT, "", " LIKE :keyword OR ", TRUE, FALSE, FALSE);
				$query .= " LIKE :keyword";

				if ($username) 
					$query .= " OR (user.id=" . $table . ".user_id AND user.username LIKE :keyword)";
				if ($searchTrainningTitle)
					$query .= " OR (trainning.id=" . $table . ".trainning_id AND trainning.title LIKE :keyword)";
			}

			if ($onlyPublishedContent || $onlyNotPremiumContent) {
				if ($onlyPublishedContent) {
					if (!empty($columns))
						$query .= " AND ";
					$query .=  " " . $table . ".status=1";
				}
				if ($onlyNotPremiumContent){
					if (!empty($columns))
						$query .= " AND ";
					$query .= " " . $table . " premium=0";
				}
			}

			if (isset($date)) {
				if (empty($columns))
						$query .= " AND ";
				$query .= " date(dateInserted) = " . $date;
			}
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

	private function isOnlyNotPremiumContent(&$columns, $table) {
		if ($key = array_search("status", $columns) && $table != "user") {
			unset($columns[$key]);
			return TRUE;
		}
		return FALSE;
	}

	private function getIfContainDate(&$columns) {
		$date = null;
		if (array_key_exists("dateInserted", $columns)) {
			$date = $columns["dateInserted"];
			unset($columns["dateInserted"]);
		}
		return $date;
	}
}