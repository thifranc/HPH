<?php
session_start();
include("shop_header.php");
include("login_form.php");
include("auth.php");


if (!file_exists("private/passwd")) {
$_SESSION = array();
	if (!is_dir("private")) {
		if (file_exists("private")) {
			unlink("private");
		}
		mkdir("private");
	}
	$user[0] = array("login" => "admin", "passwd" => hash('whirlpool', "admin"), "is_admin" => 1);
	if (!file_put_contents("private/passwd", serialize($user))) {
shop_header("Install Shop");
echo "<body>";
		echo "erreur a la creation de l'utilisateur par default";
		exit;
	}
	include ("test.php");
	header("Location: admin.php");
}
if (!$_SESSION["loggued_on_user"] && $_POST["login"] != "" && $_POST["passwd"] != "") {
	$_SESSION = array_merge($_SESSION, auth($_POST["login"], $_POST["passwd"]));
}
if ($_SESSION["loggued_on_user"] && $_SESSION["is_admin"] === 1) {
shop_header("Install Shop");
echo "<body>";
	echo "<p>loggued as ".$_SESSION["loggued_on_user"]."</p>";
} else {
shop_header("Install Shop");
echo "<body>";
	login_form("install.php");
}

?>
</body>
</html>
