<?php
include "home_form.php";
include "login_form.php";
include "shop_header.php";
session_start();
shop_header("Historique des commandes");
echo "<body>";

if ($_SESSION["loggued_on_user"])
{
home_form("index.php");

if (file_exists("private/passwd"))
{
	$tab = unserialize(file_get_contents("private/passwd"));
	if (is_array($tab))
	{
		foreach ($tab as $user)
		{
			if ($user["login"] === $_SESSION["loggued_on_user"])
			{
				if (is_array($user["commands"]))
				{
					echo "<table>";
							echo "<tr><td>Produit</td><td>Quantite</td><td>Prix Unitaire</td><td>Sous Total</td><td>Total</td><td>Status</td></tr>";
						foreach ($user["commands"] as $command)
						{
							if (isset($command["cart"]["items"]))
							{
							echo "<tr>";
								echo "<td><table>";
foreach ($command["cart"]["items"] as $item)
{
	echo "<tr><td>".$item["name"]."</td></tr>";
	}
	echo "</table></td>";
								echo "<td><table>";
foreach ($command["cart"]["items"] as $item)
{
	echo "<tr><td>".$item["quantity"]."</td></tr>";
	}
	echo "</table></td>";
								echo "<td><table>";
foreach ($command["cart"]["items"] as $item)
{
	echo "<tr><td>".$item["price"]."</td></tr>";
	}
	echo "</table></td>";
								echo "<td><table>";
foreach ($command["cart"]["items"] as $item)
{
	echo "<tr><td>".$item["sub_total"]."</td></tr>";
	}
	echo "</table></td>";
	echo "<td>".$command["cart"]["total"]."</td>";
							if ($command["shipped"] === 1)
								echo "<td>Livrée</td>";
								else
									echo "<td>En cours de Préparation</td>";
							echo "</tr>";
						}
						}
					echo "</table>";
				}
				else
					echo "<p>Pas de commandes</p>";
			}
		}
}
}
}
else
	login_form($_SERVER["PHP_SELF"]);

?>
</body>
</html>
