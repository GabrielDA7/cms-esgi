<?php
class SiteInfosDelegate {

	private $installation;

	public function __construct() {
		$this->installation = new Installation();
	}

	public function process(&$data) {
		$data['infos'] = $this->getSiteInfos($data);
	}

	private function getSiteInfos($data) {
		$siteInfos = $this->installation->getAll($data)[0];
		return $siteInfos;
	}
}