<?php
class ListDisplayDataDelegate {

  private $objectName;

  public function __construct($objectName) {
    $this->objectName = $objectName;
  }  

  public function processCommonInformations(&$data, $params) {
    $this->setItemsNumberToGet($data, $params);
    $this->setTableConfiguration($data);
    $this->setOrderByColumn($data, $params);
  }

  public function process(&$data) {
    $this->setPagination($data);
  }

  private function setOrderByColumn(&$data, $params) {
    if (!isset($params['GET']['columnName']) || !isset($params['GET']['sort'])) {
      return null;
    }
    $column = $params['GET']['columnName'];
    $order = $params['GET']['sort'];
    $data['orderBy'] = [$column => $order];
  }

  private function setItemsNumberToGet(&$data, $params) {
    $page = (isset($params['GET']['page'])) ? $params['GET']['page'] : 1;
    $itemsPerPage = (isset($params['GET']['itemsPerPage'])) ? $params['GET']['itemsPerPage'] : 30;
    $startLimit = ($page - 1) * $itemsPerPage;
    $endLimit = $startLimit + $itemsPerPage;
    $data['itemsPerPage'] = $itemsPerPage;
    $data['limit'] = [$startLimit, $endLimit];
  }

  private function setTableConfiguration(&$data) {
    $data['tableConfig'] = $this->objectName::configTable();
  }

  private function setPagination(&$data) {
    $itemsNumber = (isset($data['itemsNumber'])) ? $data['itemsNumber'] : 0;
    $pagesNumber = ceil($itemsNumber / $data['itemsPerPage']);
    $pagination['itemsNumber'] = $itemsNumber;
    $pagination['pagesNumber'] = $pagesNumber;
    $data['pagination'] = $pagination;
  }

  public function getObjectName() { return $this->objectName; }

  public function setObjectName($objectName) { $this->objectName = $objectName; }
}
?>
