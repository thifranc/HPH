<?PHP
session_start();
if ($_SESSION)
{
	$login = $_SESSION['login'];
	$passwd = $_SESSION['passwd'];
}
if ($_GET['submit'] == "OK")
{
	$_SESSION['login'] = $_GET['login'];
	$_SESSION['passwd'] = $_GET['passwd'];
	$login = $_SESSION['login'];
	$passwd = $_SESSION['passwd'];
}
?>
<html>
<form method="get" action="index.php">
Identifiant: <input type="text" name="login" id="login" value="<?= ($login) ? $login : NULL ;?>"/>
</br>
Mot de passe: <input type="password" name="passwd" id="passwd" value="<?= ($passwd) ? $passwd : NULL?>"/>
<input type="submit" name="submit" value="OK">
</form>
</html>
