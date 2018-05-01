<?php

class TableDelegate {
  private $objectName;

  public function __construct($objectName) {
    $this->objectName = $objectName;
  }

  public function process(&$data, $params) {
    $data['config'] = $this->getTableConfig($data);
    $data['errors'] = null;
  }

  private function getTableConfig($data) {
    $configName = "configTable";
    return $this->objectName::$configName($data);
  }

  public function getObjectName() { return $this->objectName; }
  public function setObjectName($objectName) { $this->objectName = $objectName; }
}
