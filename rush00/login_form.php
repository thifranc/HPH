<?php
function login_form($action)
{
	echo '<form action="'.$action.'" method="POST">
		Identifiant: <input type="text" name="login" value="" />
		<br />
		Mot de passe: <input type="password" name="passwd" value="" />
		<br />
		<input type="submit" name="submit" value="OK" />
		</form>';
}
?>
