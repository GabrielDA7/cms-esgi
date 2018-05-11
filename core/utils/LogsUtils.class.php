<?php
class LogsUtils {

	public static function process($fileName, $title, $content) {
		$log  = "IP + Date : ".$_SERVER['REMOTE_ADDR'].' - '.date("F j, Y, g:i a").PHP_EOL.
				"-----------------".PHP_EOL.
				"Url : http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]".PHP_EOL.
				"Action : ".$title.PHP_EOL.
				"Value : ".$content.PHP_EOL.
				"Date : ".$date = date('m/d/Y h:i:s a', time()).PHP_EOL.
				"-------------------------------------------------------".PHP_EOL;
		file_put_contents('bin/logs/'.$fileName.'_'.date("j.n.Y").'.log', $log, FILE_APPEND);
	}
}