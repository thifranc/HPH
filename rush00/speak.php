<?PHP

function add_msg($tab, $num, $login, $time, $msg)
{
	$tab[$num]['login'] = $login;
	$tab[$num]['time'] = $time;
	$tab[$num]['msg'] = $msg;
	$content = serialize($tab);
	$fd = fopen("private/chat", "w");
	// while (flock($fd, LOCK_EX) == FALSE) {
	// 	;
	// }
	file_put_contents("private/chat", $content);
	// flock($fd, LOCK_UN);
	fclose($fd);
}

session_start();
if (isset($_SESSION['loggued_on_user']) && $_SESSION['loggued_on_user'] !== "") {
	echo "	<html>
				<head><script langage='javascript'>top.frames['chat'].location = 'chat.php';</script></head>
				<body>
					<form action='speak.php' method='POST'>
					Message: <input autofocus type='text' name='msg' size='100' value='' />
					<input type='submit' name='submit' value='OK' />
					</form>
				</body>
			</html>";
	if (isset($_POST['msg']) === TRUE && $_POST['submit'] === "OK") {
		if (file_exists("private/chat") === FALSE) {
			$tab = array();
			if (file_exists("private") === FALSE) {
				mkdir("private");
			}
			add_msg($tab, 0, $_SESSION['loggued_on_user'], time(), $_POST['msg']);
		} else {
			$fd = fopen("private/chat", "r");
			// while (flock($fd, LOCK_SH) === FALSE) {
			// 	;
			// }
			$content = file_get_contents("private/chat");
			// flock($fd, LOCK_UN);
			fclose($fd);
			$tab = unserialize($content);
			$i = 0;
			while (isset($tab[$i])) {
				$i++;
			}
			add_msg($tab, $i, $_SESSION['loggued_on_user'], time(), $_POST['msg']);
		}
	}
} else {
	echo "ERROR\n";
}

?>
