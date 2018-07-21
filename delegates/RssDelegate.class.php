<?php
class RssDelegate {
	
	private $objectName;

	public function __construct($objectName) {
		$this->objectName = $objectName;
	}

	public function process($data) {
		if ($this->objectName == "user" || $this->objectName == "premiumoffer")
			return;
		$xmlFile = $this->createXmlFile();
		$action = str_replace("Action", "", ClassUtils::getCallingFunction());
		$headerInfos = $this->computeHeaderInfos($action);
		$channel = $this->initRssHeader($xmlFile, $headerInfos, $action);
		$items = $data[lcfirst($this->objectName) . "s"];
		$this->addItems($xmlFile, $channel, $items);
		$xmlFile->save("bin/xml/" . $action . "_" . $this->objectName. ".xml");
	}

	private function computeHeaderInfos($action) {
		$title = "Page " . $action;
		$desc = ucfirst($action) . " of " . $this->objectName;
		$protocole = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://';
		$link = $protocole . $_SERVER['SERVER_NAME'] . DIRNAME . $this->objectName . "/list";
		return ["title" => $title, "description" => $desc, "link" => $link];
	}

	private function createXmlFile() {
		$xmlFile = new DOMDocument("1.0");
		$xmlFile->preserveWhiteSpace = false;
		$xmlFile->formatOutput = true;
		return $xmlFile;
	}

	private function initRssHeader(&$xmlFile, $headerInfos, $action)
	{
        $root = $xmlFile->createElement("rss");
        $root->setAttribute("version", "2.0"); 
        $root->setAttribute("xmlns:atom", "http://www.w3.org/2005/Atom");
        $root = $xmlFile->appendChild($root); 

        $atom = $xmlFile->createElement("atom:link");
        $atom->setAttribute("href", $headerInfos['link']); 
        $atom->setAttribute("rel", "self");
        $atom->setAttribute("type", "application/rss+xml");
        $atom = $root->appendChild($atom);
        
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

        $title = $xmlFile->createElement("title");
        $title = $item->appendChild($title);
        $textElement = $xmlFile->createTextNode($itemObject->getTitle());
		$textElement = $title->appendChild($textElement);
        
        $authorText = $itemObject->getUser()->getEmail() . "(" . $itemObject->getUser()->getUsername() . ")";
        $author = $xmlFile->createElement("author");
        $author = $item->appendChild($author);
        $textElement = $xmlFile->createTextNode($authorText);
		$textElement = $author->appendChild($textElement);



        /*foreach ($columns as $key => $value) {
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
        }*/
		$this->computeLinkToContent($xmlFile, $item, $columns);    
	}

	private function computeLinkToContent(&$xmlFile, &$item, $columns) {
		$objectName = strtolower($columns['objectName']);
		$protocole = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://';
		$urlOfobject = $protocole . $_SERVER['SERVER_NAME'] . DIRNAME . $objectName . "/" . $objectName . "?id=" . $columns['id'];
        $link = $xmlFile->createElement("link");
        $link = $item->appendChild($link);
        $url = $xmlFile->createTextNode($urlOfobject);
        $url = $link->appendChild($url);

        $guid = $xmlFile->createElement("guid");
        $guid = $item->appendChild($guid);
        $url = $xmlFile->createTextNode($urlOfobject);
        $url = $guid->appendChild($url);
	}
}