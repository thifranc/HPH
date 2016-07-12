<?PHP
include "auth.php";

session_start();
if (isset($_SESSION['loggued_on_user']) === FALSE) {
	if (isset($_POST["login"]) && isset($_POST["passwd"])) {
		$auth = auth($_POST['login'], $_POST['passwd']);
		if ($auth[0] === TRUE) {
			$_SESSION['loggued_on_user'] = $_POST['login'];
			$_SESSION['is_admin'] = $auth[1];
			echo "	<html><body>
						<iframe name='chat' src='chat.php' width='100%' height='550px'></iframe>
						<iframe name='speak' src='speak.php' width='100%' height='50px'></iframe>
						<br />
						<form action='logout.php'>
						<input type='submit' name='submit' value='D&eacute;connexion' method='POST' />
						</form>
					</body></html>";
		} else {
			echo "ERROR\n";
		}
	} else {
		echo "ERROR\n";
	}
}

?>
