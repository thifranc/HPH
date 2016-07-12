<?php

include_once('doc.trait.php'); 
class Router {
	use Doc;
	private static $doc_path = 'back/Map.doc.txt';

	public static function listenPost($callback) {
		$callback($_POST);
	}
}

?>
