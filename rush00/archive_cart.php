<?php
function archive_cart()
{
	if (file_exists("private/passwd"))
	{
		$tab = unserialize(file_get_contents("private/passwd"));
		if (is_array($tab))
		{
			foreach($tab as $id => $user)
			{
				if ($user["login"] === $_SESSION["loggued_on_user"])
				{
					$tab[$id]["cart"] = $_SESSION["cart"];
				if (file_put_contents("private/passwd", serialize($tab)))
				{
					echo "<p>Panier archivé</p>";
				return;
				}
			}
		}
	}
	}
					echo "<p class=error>Erreur a l'archivage du panier</p>";
					return;
}
?>
