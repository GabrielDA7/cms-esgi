<?php
class TableDelegate {

  private $objectName;

  public function __construct($objectName) {
    $this->objectName = $objectName;
  }

  public function process(&$data) {
    $data['config'] = $this->objectName::configTable();
    $data['errors'] = null;
  }

  public function getObjectName() { return $this->objectName; }

  public function setObjectName($objectName) { $this->objectName = $objectName; }
}
?>
