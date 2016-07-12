<?php
function modify_form($action)
{
	echo '<form action="'.$action.'" method="POST">
		<p>Pour modifier le mot de passe du compte "'.$_SESSION["loggued_on_user"].'" , merci de rentrer votre ancien mot de passe</p>
		Mot de passe: <input type="password" name="old_pwd" value="" />
		<br />
		Nouveau mot de passe: <input type="password" name="new_pwd" value="" />
		<br />
		<input type="hidden" name="form" value="modif_user" />
		<input type="submit" name="submit" value="Modifier" />
		</form>';
}
?>
