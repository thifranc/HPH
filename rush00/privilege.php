<?php
session_start();
include("shop_header.php");
include("login_form.php");
include("auth.php");
include("home_form.php");

if (file_exists("private/passwd"))
{
	//Modifier le titre de la page
	home_form("index.php");
	shop_header("Modification des utilisateurs");
	echo "<body>";
	if (!$SESSION["loggued_on_user"] && $_POST["login"] != "" && $_POST["passwd"] != "")
		$_SESSION = array_merge($_SESSION, auth($_POST["login"], $_POST["passwd"]));
	if ($_SESSION["loggued_on_user"])
	{

		if ($_POST["form"] === "is_admin" && $_POST["envoi"] === "Changer droits Utilisateurs")
		{
			include("modify_privileges.php");
			modify_privileges($_POST["is_admin"]);
		}
		else if ($_POST["form"] === "is_admin" && $_POST["envoi"] === "Supprimer Utilisateurs")
		{
			include("user_deleter.php");
			if ($_POST['to_delete'])
			{
				foreach ($_POST["to_delete"] as $usr_to_delete)
				{
					if ($usr_to_delete != $_SESSION["loggued_on_user"])
						user_deleter($usr_to_delete);
				}
			}
		}


		$tab = unserialize(file_get_contents("private/passwd"));
		if (is_array($tab))
		{
			echo "<form action='". $_SERVER['REQUEST_URI'] . "' method='post'>";
			echo "<table>";
			echo "<tr><td>Utilisateur</td><td>Admin</td><td>Supprimer Utilisateur</td></tr>";
			foreach ($tab as $user)
			{
				echo "<tr>
					<td>". $user["login"] . "</td>
					<td>
					<input type='checkbox' name='is_admin[]' value='". $user['login']. "'";
				if ($user["is_admin"])
					echo " checked='checked'";
				if ($user["login"] == $_SESSION["loggued_on_user"])
					echo " disabled";
				echo "></td>";
				echo"<td><input type='checkbox' name='to_delete[]' value='". $user['login']. "'";
				if ($user["login"] == $_SESSION["loggued_on_user"])
					echo " disabled";
				echo "></td>";
				echo "</tr>";
			}
			echo "</table>";
			echo "<input type='hidden' name='form' value='is_admin' />";
			echo "<input type='submit' name='envoi' value='Changer droits Utilisateurs' />";
			echo "<input type='submit' name='envoi' value='Supprimer Utilisateurs' /></form>";
		}
		else
			echo "Probleme à la lecture de la base utilisateur";
	}
	else
	{
		login_form($_SERVER['PHP_SELF']);
	}
}
else
	header("Location: install.php");
?>
</body>
</html>
