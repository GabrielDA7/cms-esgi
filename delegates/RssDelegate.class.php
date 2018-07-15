<?php
class RssDelegate {
	
	private $objectName;

	public function __construct($objectName) {
		$this->objectName = $objectName;
	}

	public function process($data) {
		if ($this->objectName == "user")
			return;
		$xmlFile = $this->createXmlFile();
		$action = str_replace("Action", "", ClassUtils::getCallingFunction());
		$headerInfos = $this->computeHeaderInfos($action);
		$channel = $this->initRssHeader($xmlFile, $headerInfos);
		$items = $data[lcfirst($this->objectName) . "s"];
		$this->addItems($xmlFile, $channel, $items);
		$xmlFile->save("bin/xml/" . $action . "_" . $this->objectName. ".xml");
	}

	private function computeHeaderInfos($action) {
		$title = "Page " . $action;
		$desc = ucfirst($action) . " of " . $this->objectName;
		$link = $_SERVER['SERVER_NAME'] . DIRNAME . $this->objectName . "/list";
		return ["title" => $title, "desc" => $desc, "link" => $link];
	}

	private function createXmlFile() {
		$xmlFile = new DOMDocument("1.0");
		$xmlFile->preserveWhiteSpace = false;
		$xmlFile->formatOutput = true;
		return $xmlFile;
	}

	private function initRssHeader(&$xmlFile, $headerInfos)
	{
        $root = $xmlFile->createElement("rss");
        $root->setAttribute("version", "2.0"); 
        $root = $xmlFile->appendChild($root); 
        
        $channel = $xmlFile->createElement("channel");
        $channel = $root->appendChild($channel);
        
        foreach ($headerInfos as $key => $value) {
        	$element = $xmlFile->createElement($key);
	        $element = $channel->appendChild($element);
	        $text = $xmlFile->createTextNode($value); 
	        $text = $element->appendChild($text);
        }
        
        return $channel;
	}

	private function addItems(&$xmlFile, $root, $items) {
		foreach ($items as $key => $item) {
			$this->addItem($xmlFile, $root, $item);
		}
	}

	private function addItem(&$xmlFile, $root, $itemObject)
	{
        $item = $xmlFile->createElement("item");
        $item = $root->appendChild($item);
        
        $columns = $itemObject->getColumns();
        ClassUtils::removeDBColumns($columns);

        foreach ($columns as $key => $value) {
        	if (!is_array($value) && isset($value)) {
        		if (!is_object($value)) {
		        	$element = $xmlFile->createElement($key);
			        $element = $item->appendChild($element);
			        $textElement = $xmlFile->createTextNode($value);
			        $textElement = $element->appendChild($textElement);
        		} elseif ($key != "db") {
        			$this->addItem($xmlFile, $item, $value);
		    	}
        	}
        }
		$this->computeLinkToContent($xmlFile, $item, $columns);    
	}

	private function computeLinkToContent(&$xmlFile, &$item, $columns) {
		$objectName = strtolower($columns['objectName']);
		$urlOfobject = $_SERVER['SERVER_NAME'] . DIRNAME . $objectName . "/" . $objectName . "?id=" . $columns['id'];
        $link = $xmlFile->createElement("link");
        $link = $item->appendChild($link);
        $url = $xmlFile->createTextNode($urlOfobject);
        $url = $link->appendChild($url);
	}
}