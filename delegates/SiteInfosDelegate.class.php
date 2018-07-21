<?php
class SiteInfosDelegate {

	public function process(&$data) {
		$data['infos'] = $this->getSiteInfos($data);
		$data['pages'] = $this->getPagesToShow($data);
	}

	private function getSiteInfos($data) {
		$installation = new Installation();
		$siteInfos = $installation->getAll($data)[0];
		return $siteInfos;
	}

	private function getPagesToShow($data) {
		$page = new Page();
		$page->setStatus(1);
		$pages = $page->getWithParameters($data);
		return $pages;
	}
}