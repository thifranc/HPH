<?php
session_start();
include("shop_header.php");
include("login_form.php");
include("auth.php");

if (file_exists("private/passwd")) {
	//Modifier le titre de la page
	shop_header("Modification des utilisateurs");
	if (!$SESSION["loggued_on_user"] && $_POST["login"] != "" && $_POST["passwd"] != "") {
		$_SESSION = array_merge($_SESSION, auth($_POST["login"], $_POST["passwd"]));
	}
	if ($_SESSION["loggued_on_user"]) {







	} else {
		login_form($_SERVER['PHP_SELF']);
	}
} else {
	header("Location: install.php");
}
?>
</body></html>
