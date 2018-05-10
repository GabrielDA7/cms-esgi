<?php
class ListDisplayDataDelegate {

  private $objectName;

  public function __construct($objectName) {
    $this->objectName = $objectName;
  }  

  public function process(&$data, $params) {
    $this->setItemsPerPage($data, $params);
    $this->setTableConfig($data);
  }

  public function process(&$data) {
    $this->setPagination($data);
  }

  private function setItemsToGet(&$data) {
    $page = (isset($params['GET']["page"])) ? $params['GET']["page"] : 1;
    $itemsPerPage = (isset($params['GET']["itemsPerPage"])) ? $params['GET']["itemsPerPage"] : 30;
    $startLimit = ($page - 1) * $itemsPerPage;
    $endLimit = $startLimit + $itemsPerPage;
    $data['limit'] = [$startLimit, $endLimit];
  }

  private function setTableConfiguration(&$data) {
    $data['tableConfig'] = $this->objectName::configTable();
  }

  private function setPagination(&$data) {
    $itemsNumber = $data['itemsNumber'];
    $pagesNumber = ceil($itemsNumber / $itemsPerPage);
    $pagination["itemsNumber"] = $itemsNumber;
    $pagination["pagesNumber"] = $pagesNumber;
    $data['pagination'] = $pagination;
  }

  public function getObjectName() { return $this->objectName; }

  public function setObjectName($objectName) { $this->objectName = $objectName; }
}
?>
