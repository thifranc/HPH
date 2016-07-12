<?php
session_start();
include("login_form.php");
include("auth.php");
include("shop_header.php");
include("admin_pane.php");
if ($_SESSION['is_admin'] != 1)
	header("Location: index.php");

shop_header("Shop Administration");


if (isset($_POST['usr_id']) && isset($_POST['cmd_id'])) {
	$tab = unserialize(file_get_contents("private/passwd"));
	$tab[$_POST['usr_id']]['commands'][$_POST['cmd_id']]['shipped'] = 1;
	if (file_put_contents("private/passwd", serialize($tab)) === FALSE) {
		echo "ERROR\n";
	}
}

?>
<?php
if (!$SESSION["loggued_on_user"] && $_POST["login"] != "" && $_POST["passwd"] != "")
   $_SESSION = array_merge($_SESSION, auth($_POST["login"], $_POST["passwd"]));



 if ($_SESSION["loggued_on_user"])
	   {

admin_left();
echo "<div class='window'>";

		$tab = unserialize(file_get_contents("private/passwd"));
		if (is_array($tab)) {
			foreach($tab as $id_usr => $user) {
				if (isset($user['commands'])) {
					echo "<table>";
					echo "<tr><td>Client</td><td>Produit</td><td>Quantite</td><td>Prix Unitaire</td><td>Sous Total</td><td>Total</td><td>Status</td></tr>";
					foreach ($user["commands"] as $id_cmd => $command) {
						if (isset($command["cart"]["items"])) {
							echo "<tr>";
							echo "<td>".$user["login"]."</td>";
							echo "<td><table>";
							foreach ($command["cart"]["items"] as $item) {
								echo "<tr><td>".$item["name"]."</td></tr>";
							}
							echo "</table></td>";
							echo "<td><table>";
							foreach ($command["cart"]["items"] as $item) {
								echo "<tr><td>".$item["quantity"]."</td></tr>";
							}
							echo "</table></td>";
							echo "<td><table>";
							foreach ($command["cart"]["items"] as $item) {
								echo "<tr><td>".$item["price"]."</td></tr>";
							}
							echo "</table></td>";
							echo "<td><table>";
							foreach ($command["cart"]["items"] as $item) {
								echo "<tr><td>".$item["sub_total"]."</td></tr>";
							}
							echo "</table></td>";
							echo "<td>".$command["cart"]["total"]."</td>";
							echo "<td><form action=".$_SERVER['PHP_SELF']." method='POST'>";
							echo "<input type='submit' ";
							if ($command["shipped"] === 1) {
								echo "value='Commande validée' disabled";
							} else {
								echo "value='Valider la commande'";
							}
							echo ">";
							echo "<input type='hidden' name='usr_id' value='".$id_usr."'>";
							echo "<input type='hidden' name='cmd_id' value='".$id_cmd."'>";
							echo "</form></td></tr>";
						}
					}
					echo "</table>";
				}
			}
		}
echo "</div>";
 admin_right() ;
 }
 else
login_form($_SERVER['PHP_SELF']);
?>
