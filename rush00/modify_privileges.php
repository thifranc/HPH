<?php
function modify_privileges($tab_admin)
{
	if (!is_array($tab_admin))
		$tab_admin = array();
$tab = unserialize(file_get_contents("private/passwd"));
if (is_array($tab))
{
	foreach ($tab as $key => $user)
	{
		if ($user["login"] != $_SESSION["loggued_on_user"])
		{
	if (in_array($user["login"], $tab_admin))
		$tab[$key]['is_admin'] = 1;
	else
		$tab[$key]['is_admin'] = 0;
		}
	}
	if (file_put_contents("private/passwd", serialize($tab)))
		echo "<p>Modification des droits d'utilisateurs bien prise en compte</p>";
	else
	echo "<p class='error'>Erreur à l'écriture du fichier de mot de passe</p>";
}
else
	echo "<p class='error'>Erreur sur le fichier de mot de passe</p>";

}
?>
