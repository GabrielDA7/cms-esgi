<?php
class AjaxController {

	private $objectDelegate;
	private $data = [];

	public function __construct() {
		if (!isset($_GET['object'])) {
			echo FormatUtils::formatToJson([]);
			exit;
		}
		$_GET['object'] = ucfirst($_GET['object']);
		$this->objectDelegate = new ObjectDelegate($this->data, $_GET['object']);
	}

	public function searchAction($params) {
		$page = '';
		$output = '';
		if( isset($_POST["page"]) && isset($_POST["limit"]) ) {
			$page = $_POST["page"];
			$record_per_page = $_POST["limit"];
		} else {
			$page = 1;
			$record_per_page = 10;
		}
		$start_from = ($page - 1)*$record_per_page;

		$objects = $this->objectDelegate->search($params);
		$array["data"] = FormatUtils::formatObjectsArrayToArray($objects);

		$total_records = 16; // count select *
		$total_pages = ceil($total_records/$record_per_page);
		$array["total_page"] = $total_pages;
		$array["total_records"] = $total_records;

		echo FormatUtils::formatToJson($array);
	}

	public function filterAction($params) {
		echo FormatUtils::formatToJson($this->objectDelegate->filter($params));
	}

	public function listAction($params) {
		$page = '';
		$output = '';
		if( isset($_POST["page"]) && isset($_POST["limit"]) ) {
			$page = $_POST["page"];
			$record_per_page = $_POST["limit"];
		} else {
			$page = 1;
			$record_per_page = 10;
		}
		$start_from = ($page - 1)*$record_per_page;

		// TODO : faire une requete qui récupère les enregistrement avec un LIMIT par rapport au post[limit], get(params)
		// ex : $query = "SELECT * FROM tbl_student ORDER BY student_id DESC LIMIT $start_from, $record_per_page"; OUBLIE PAS LE SELECT POUR FILTRER LES ELEMENT DANS L'ORDRE de LA CONF
		$objects = $this->objectDelegate->getAll($params);
		$array["data"] = FormatUtils::formatObjectsArrayToArray($objects);

		// TODO : faire une requete qui récupère le nombre total d'enregistrement ( ca permet de faire la pagination ), getCount(params)
		// faudrait peut etre trouver un moyen pour pas l'executer à chaque fois
		$total_records = 16; // count select *
		$total_pages = ceil($total_records/$record_per_page);
		$array["total_page"] = $total_pages;
		$array["total_records"] = $total_records;

		echo FormatUtils::formatToJson($array);
	}
}
?>
