<?php
session_start();
date_default_timezone_set("Europe/Paris");
function create_dir() {
	if (!file_exists("../private")) {
		mkdir("../private");
	}
}
function get_data() {
	if (file_exists("../private/chat")) {
		return unserialize(file_get_contents("../private/chat", LOCK_SH));
	} else {
		return array();
	}
}
function store_data($data) {
	file_put_contents("../private/chat", serialize($data), LOCK_SH);
}
if (!$_SESSION['login']) {
	header('Location: lobby.php');
}
create_dir();
$data = get_data();
if ($_POST["msg"] && $_POST["msg"] != "") {
	$formated = array();
	$formated["login"] = $_SESSION["login"];
	$formated["time"] = time();
	$formated["msg"] = htmlspecialchars($_POST["msg"]);
	$data[] = $formated;
	store_data($data);
}
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Send</title>
	</head>
	<body>
		<form action="speak.php" method="post">
			<input type="text" name="msg">
			<input type="submit" name="submit" value="Envoyer">
		</form>
	</body>
</html>
