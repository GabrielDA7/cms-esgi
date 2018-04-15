<?php
class LogsUtils {

	public static function process($title, $content) {
		$log  = "IP + Date : ".$_SERVER['REMOTE_ADDR'].' - '.date("F j, Y, g:i a").PHP_EOL.
			"-----------------".PHP_EOL.
			"Action : ".$title.PHP_EOL.
			"Value : ".$content.PHP_EOL.
			"Date : ".$date = date('m/d/Y h:i:s a', time()).PHP_EOL.
			"-------------------------------------------------------".PHP_EOL;
		file_put_contents('bin/logs/log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
	}
}