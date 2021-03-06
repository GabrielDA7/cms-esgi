<?php
class StatisticDelegate {
	
	private $objectName;
	private $statisticObject;

	public function __construct($objectName = null) {
		$this->objectName = $objectName;
		$table = "viewed_" . lcfirst($this->objectName);
		$this->statisticObject = new Statistic($table);
	}

	public function processAdd($params) {
		$this->computeStatisticObject($params);
		if ($this->isViewAlreadyExists())
			return;
		$this->statisticObject->setDateInserted(null);
		$this->statisticObject->insert();
	}

	public function processGet(&$data) {
		$arrayOfContents = [TRAINNING_CLASS_NAME, CHAPTER_CLASS_NAME, VIDEO_CLASS_NAME];
		foreach ($arrayOfContents as $contentObjectName) {
			$table = "viewed_" . lcfirst($contentObjectName);
			$this->statisticObject = new Statistic($table);
			$this->computeTopContents($data, $contentObjectName);
			$this->computeTotalViews($data, $contentObjectName);
		}
		$this->computeTotalPremium($data);
		$this->computeViewsHistory($data);
	}

	private function computeViewsHistory(&$data) {
		//$time = ["duration" => $params['GET']['duration'] ?? null, "type" => $params['GET']['type'] ?? null];
		$data["viewsHistory"] = $this->statisticObject->getStatisticViewsHistory();
	}

	private function isViewAlreadyExists() {
		$result = $this->statisticObject->getWithParameters(null);
		if (!empty($result))
			return TRUE;
		return FALSE;
	}

	private function computeTotalPremium(&$data) {
		$user = new User();
		$user->setRole(PREMIUM_ROLE);
		$data["totalPremiums"] = $user->countItems();
	}

	private function computeStatisticObject($params) {
		$ip = $_SERVER['REMOTE_ADDR'];
		$contentId = $params['id'];
		$contentSetter = "set" . $this->objectName . "Id";
		$user_id = (isset($_SESSION['userID'])) ? $_SESSION['userID'] : null;
		$todayDate = date("Y-m-d");
		$this->statisticObject->setIp($ip);
		$this->statisticObject->$contentSetter($contentId);
		$this->statisticObject->setUserId($user_id);
		$this->statisticObject->setDateInserted($todayDate);
	}

	private function computeTopContents(&$data, $contentObjectName) {
		$id = lcfirst($contentObjectName) . "_id";
		$results = $this->statisticObject->countItems($id);
		$data["top".$contentObjectName] = $this->getTop3Contents($results, $contentObjectName);	
	}

	private function getTop3Contents($sqlResult, $contentObjectName) {
		$top3Contents = [];
		foreach ($sqlResult as $key => $value) {
			$stat = new Statistic($contentObjectName);
			$stat->setViews($value["itemsNumber"]);
			$object = new $contentObjectName();
			$object->setId($value["id"]);
			$object = $object->getById();
			$setterObject = "set" . $contentObjectName;
			$stat->$setterObject($object);
			$top3Contents[] = $stat;
		}
		return $top3Contents;
	}

	private function computeTotalViews(&$data, $arrayOfContents) {
		$views = $this->statisticObject->countItems();
		if (isset($data['totalViews']))
			$data['totalViews'] += $views;
		else
			$data['totalViews'] = $views;
	}
}