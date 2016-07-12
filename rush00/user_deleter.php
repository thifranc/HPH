<?php
function admin_count($tab)
{
$count = 0;
foreach ($tab as $user)
{
	if ($user["is_admin"])
		$count++;
}
return($count);
}


function user_deleter($login)
{
$tab = unserialize(file_get_contents("private/passwd"));
if (is_array($tab))
{
	foreach ($tab as $key => $user)
	{
		if ($user["login"] === $login)
		{
		unset($tab[$key]);
		}
	}
	if (admin_count($tab))
	{
	if (file_put_contents("private/passwd", serialize($tab)))
	{
		echo "<p>Suppression du compte '".$login."' bien prise en compte</p>";
		if ($_SESSION["loggued_on_usr"] === $login)
		$_SESSION = array();
		}
	else
	echo "<p class='error'>Erreur à l'écriture du fichier de mot de passe</p>";
	}
	else
	echo "<p class='error'>Vous ne pouvez pas supprimer le dernier administrateur</p>";
	}
else
	echo "<p class='error'>Erreur sur le fichier de mot de passe</p>";
}
?>
