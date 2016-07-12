<?php
function delete_form($action)
{
	echo '<form action="'.$action.'" method="POST">
		<p>Pour supprimer votre compte "'.$_SESSION["loggued_on_user"].'" , merci de rentrer votre mot de passe</p>
		Mot de passe: <input type="password" name="del_passwd" value="" />
		<br />
		<input type="hidden" name="form" value="del_user" />
		<input type="submit" name="submit" value="Supprimer" />
		</form>';
}
?>
