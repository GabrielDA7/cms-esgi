<?php
class SiteMapDelegate {

	private $links = [];

	public function processStart() {
		$fullUrl = $this->computeFullUrl(DIRNAME . "index/crawl");
		$fullUrl .= "?url=" . DIRNAME;
		$curl = $this->curlInitialization($fullUrl);
		curl_exec($curl);
		curl_close($curl);
	}

	public function process($params) {
		$todayDate = date("Y-m-d");
		if ($this->isTodayFileExist($todayDate) || $this->isSiteMapIsInProcess($params) || !isset($params['GET']['url']))
			return;
		if ($params['GET']['url'] == "") {
			$this->createSiteMap($todayDate);
			$this->deleteTempsFiles();
			return;
		}
		$this->scanSiteUrl($params['GET']['url']);
		$this->sendNextUrlToCrawl();
	}

	private function isSiteMapIsInProcess($params) {
		$filename = "bin/crawler/temp_links_crawled.xml";
		$filename2 = "bin/crawler/temp_links.xml";
		if ((file_exists($filename) || file_exists($filename)) && !isset($params['GET']['process']))
			return TRUE;
		return FALSE;
	}

	private function createSiteMap($todayDate) {
		$xmlFile = $this->createXmlFile();
		$this->computeXMLContentFromCrawledLinks($xmlFile, $todayDate);
		$xmlFile->save("siteMap.xml");
		$xmlFile->save("bin/xml/siteMap/siteMap_" . $todayDate . ".xml");
	}

	private function deleteTempsFiles() {
		sleep(5);
		unlink("bin/crawler/temp_links.xml");
		unlink("bin/crawler/temp_links_crawled.xml");
	}

	private function computeXMLContentFromCrawledLinks($xmlFile, $todayDate) {
		$filename = "bin/crawler/temp_links_crawled.xml";
		$links = $this->getLinksFromFile($filename);
		$root = $xmlFile->createElement("urlset");
        $root = $xmlFile->appendChild($root);
		foreach ($links as $link) {
			$url = $xmlFile->createElement("url");
        	$url = $root->appendChild($url);

			$item = $xmlFile->createElement("loc");
        	$item = $url->appendChild($item);
	        $textElement = $xmlFile->createTextNode($link);
			$textElement = $item->appendChild($textElement);

			$lastmod = $xmlFile->createElement("lastmod");
        	$lastmod = $url->appendChild($lastmod);
	        $textElement = $xmlFile->createTextNode($todayDate);
			$textElement = $lastmod->appendChild($textElement);

			$changefreq = $xmlFile->createElement("changefreq");
        	$changefreq = $url->appendChild($changefreq);
	        $textElement = $xmlFile->createTextNode("daily");
			$textElement = $changefreq->appendChild($textElement);

			$priority = $xmlFile->createElement("priority");
        	$priority = $url->appendChild($priority);
	        $textElement = $xmlFile->createTextNode(1);
			$textElement = $priority->appendChild($textElement);
		}
	}

	private function isTodayFileExist($todayDate) {
		$filename = "bin/xml/siteMap/siteMap_" . $todayDate . ".xml";
		if (file_exists($filename))
			return TRUE;
		return FALSE;
	}

	private function scanSiteUrl($url) {
		$sourceCode = $this->getSourceCode($url);
		$xmlFile = $this->parseHTMLToXML($sourceCode);
		$pageLinks = $this->searchLinksFromXML($xmlFile);
		$this->getLinksFromLinksFiles();
		$this->filterLinks($pageLinks, $url);
		$this->pushLinks($pageLinks);
		$this->createTempLinksCrawledFile($url);
		$this->createTempLinksFile();
	} 

	private function getLinksFromLinksFiles() {
		$filename = "bin/crawler/temp_links.xml";
		$links = $this->getLinksFromFile($filename);
		$this->links = $links;
	}

	private function sendNextUrlToCrawl() {
		$fullUrl = $this->computeFullUrl(DIRNAME . "index/crawl");
		$this->links = array_values($this->links);
		$url = isset($this->links[0]) ? $this->links[0] : "";
		$fullUrl .= "?url=" . $url . "&process=1";
		$curl = $this->curlInitialization($fullUrl);
		curl_exec($curl);
		curl_close($curl);
	}

	private function pushLinks($links) {
		$this->links = array_merge($this->links, $links);
	}

	private function filterLinks(&$links, $url) {
		$i = 0;
		foreach ($links as $link) {
			if (in_array($link, $this->links))
				unset($links[$i]);
			if (strpos($link, '/') === FALSE)
				unset($links[$i]);
			if (strpos($link, "http") == TRUE || strpos($link, "https") == TRUE)
				unset($links[$i]);
			if ($link == $url)
				unset($links[$i]);
			$i++;
		}
		if (!empty($this->links))
			$this->links = array_diff($this->links, [$url]);
	}

	private function parseHTMLToXML($sourceCode) {
		$xmlFile = new DOMDocument();
		@$xmlFile->loadHTML($sourceCode);
		return $xmlFile;
	}

	private function searchLinksFromXML($xmlFile) {
		$links = [];
		$linksTags = $xmlFile->getElementsByTagName('a');
		foreach ($linksTags as $linkTag) {
			$links[] = $linkTag->getAttribute('href');
		}
		return $links;
	}

	private function getSourceCode($url) {
		$fullUrl = $this->computeFullUrl($url);
		$sourceCode = file_get_contents($fullUrl);
		return $sourceCode;
	}

	private function curlInitialization($url) {
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_TIMEOUT, 1);
		return $curl;
	}

	private function computeFullUrl($url) {
		$protocole = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://';
		return $protocole . $_SERVER['SERVER_NAME'] . $url;
	}

	private function computeXMLContentFromLinks($xmlFile, $links) {
		$root = $xmlFile->createElement("links");
        $root = $xmlFile->appendChild($root);
		foreach ($links as $link) {
			$item = $xmlFile->createElement("link");
        	$item = $root->appendChild($item);
	        $textElement = $xmlFile->createTextNode($link);
			$textElement = $item->appendChild($textElement);
		}
	}

	private function getLinksFromFile($filename, $url = null) {
		$links = [];
		if (file_exists($filename)) {
			$xmlFile = new DOMDocument();
			$xmlFile->load($filename);
			$linksXml = $xmlFile->getElementsByTagName('link');
			foreach ($linksXml as $linkXml) {
				$links[] = $linkXml->nodeValue;
			}
		}
		if (isset($url) && !in_array($url, $links))
			$links[] = $url;
		return $links;
	}

	private function createTempLinksFile() {
		$xmlFile = $this->createXmlFile();
		$this->removeCrawledLinks();
		$this->computeXMLContentFromLinks($xmlFile, $this->links);
		$xmlFile->save("bin/crawler/temp_links.xml");
	}

	private function removeCrawledLinks() {
		$filename = "bin/crawler/temp_links_crawled.xml";
		$crawledLinks = $this->getLinksFromFile($filename);
		$this->links = array_diff($this->links, $crawledLinks);
	}

	private function createTempLinksCrawledFile($url) {
		$xmlFile = $this->createXmlFile();
		$filename = "bin/crawler/temp_links_crawled.xml";
		$links = $this->getLinksFromFile($filename, $url);
		$this->computeXMLContentFromLinks($xmlFile, $links);
		$xmlFile->save($filename);
	}

	private function createXmlFile() {
		$xmlFile = new DOMDocument();
		$xmlFile->preserveWhiteSpace = false;
		$xmlFile->formatOutput = true;
		return $xmlFile;
	}
}