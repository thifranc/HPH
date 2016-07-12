<?PHP
session_start();
	include ("auth.php");
if (auth($_POST['login'], $_POST['passwd']) == TRUE)
{
	$_SESSION['loggued_on_user'] = $_POST['login'];
	echo
	<<<html
<html>
<meta charset="UTF-8">
<iframe name="chat" src="chat.php" width="100%" height="550px"></iframe>
<iframe name="speak" src="speak.php" width="100%" height="50px"></iframe>
<form method="post" action="logout.php">
<input type="submit" name="logout" value="Logout">
</form>
</html>
html;
}
else
{
	$_SESSION['loggued_on_user'] = NULL;
	header("Location: index.html");
}
?>
