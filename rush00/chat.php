<?PHP

if (file_exists("private/chat")) {
	$fd = fopen("private/chat", "r");
	// while (flock($fd, LOCK_EX) === FALSE) {
	// 	;
	// }
	$content = file_get_contents("private/chat");
	// flock($fd, LOCK_UN);
	fclose($fd);
	$tab = unserialize($content);
	date_default_timezone_set('Europe/Paris');
	$i = 0;
	while (isset($tab[$i])) {
		echo "[".date("H:i", $tab[$i]['time'])."] <b>".$tab[$i]['login']."</b>: ".$tab[$i]['msg']."<br />\n";
		$i++;
	}
}

?>
