<?php
function buy_cart()
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
					$tab[$id]["commands"][]["cart"] = $_SESSION["cart"];
					unset($tab[$id]["cart"]);
				if (file_put_contents("private/passwd", serialize($tab)))
				{
					echo "<p>Commande effectuée</p>";
					unset($_SESSION["cart"]);
				return;
				}
				}
			}
		}
	}
					echo "<p class=error>Erreur a la validation de la commande</p>";
					return;
}
?>
