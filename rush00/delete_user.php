<?php
session_start();
include("shop_header.php");
include("login_form.php");
include("delete_form.php");
include("user_deleter.php");
include("auth.php");

if (file_exists("private/passwd")) {
	//Modifier le titre de la page
	shop_header("Suppression des utilisateurs");
	echo "<body>";
	if (!$SESSION["loggued_on_user"] && $_POST["login"] != "" && $_POST["passwd"] != "") {
		$_SESSION = array_merge($_SESSION, auth($_POST["login"], $_POST["passwd"]));
	}
	if ($_SESSION["loggued_on_user"]) {
if ($_POST["form"] === "del_user" && $_POST["del_passwd"])
{
if (auth($_SESSION["loggued_on_user"], $_POST["del_passwd"])["loggued_on_user"] != "")
{
user_deleter($_SESSION["loggued_on_user"]);
echo '<META HTTP-EQUIV=REFRESH CONTENT="2;logout.php">';
	}
	else
	{
		echo "<p class=echec>Mot de passe incorrect</p>";
		delete_form($_SERVER['PHP_SELF']);
		}
		}
else
{
		delete_form($_SERVER['PHP_SELF']);
		}
	} else {
		login_form($_SERVER['PHP_SELF']);
	}
} else {
	header("Location: install.php");
}
?>
<a href="index.php">RETOUR A L'ACCUEIL</a>
</body></html>
