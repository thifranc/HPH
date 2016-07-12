<?php
session_start();
include("shop_header.php");
include("login_form.php");
include("auth.php");
include("admin_pane.php");

if (file_exists("private/passwd")) {
	shop_header("Administration des Items");
	if (!$SESSION["loggued_on_user"] && $_POST["login"] != "" && $_POST["passwd"] != "") {
		$_SESSION = array_merge($_SESSION, auth($_POST["login"], $_POST["passwd"]));
	}
	if ($_SESSION["loggued_on_user"] && $_SESSION["is_admin"]) {

		if (file_exists("private/item") === TRUE) {
			$content = file_get_contents("private/item");
			$tab = unserialize($content);
			if (is_array($tab)) {
				admin_left();
				echo "<div class='window'>";
				echo "<table><tr>";
				echo "<td>nom</td>";
				echo "<td>prix</td>";
				echo "<td>quantité</td>";
				echo "<td>categorie</td></tr>";
				foreach($tab['item'] as $ref_item => $item) {
					echo 	"<tr><form action='add_item.php' method='POST'>";
					foreach($item as $key => $val) {
						if (is_array($val)) {
							echo "<td><table>";
							foreach ($tab['cat'] as $ref_cat => $name) {
								echo "<tr><td>'".$name."'</td>";
								echo "<td><input type='checkbox' name='".$ref_cat."'";
								if (in_array($ref_cat, $val)) {
									echo " checked";
								}
								echo " ></tr>";
							}
							echo "</table></td>";
						} else if ($key === 'price' || $key === 'number') {
							echo "<td><input type='number' name=".$key." value=".$val."></td>";
						} else if ($key !== 'ref' && $key !== 'sold') {
							echo "<td><input type='text' name=".$key." value=".$val."></td>";
						}
					}
					echo "<td><input type='submit' name='submit' value='OK' method='POST' /></td>";
					echo "<td><input type='submit' name='submit' value='DEL' method='POST' /></td>";
					echo "<input type='text' name='ref' value=".$ref_item." hidden></form></tr>";
				}
				echo "<tr><form action='add_item.php' method='POST'>";
				echo "<td><input type='text' name='name' value='' /></td>";
				echo "<td><input type='number' name='price' value='' /></td>";
				echo "<td><input type='number' name='number' value='' /></td>";
				echo "<td><table>";
				foreach ($tab['cat'] as $ref_cat => $name) {
					echo "<tr><td>'".$name."'</td>";
					echo "<td><input type='checkbox' name='".$ref_cat."'></tr>";
				}
				echo "</table></td>";
				echo "<td><input type='submit' name='submit' value='OK' method='POST' /></td>";
				echo "</form></tr></table>";
				echo "<br /><br /><br />";
				echo "<table><tr>";
				echo "<td>nom</td>";
				foreach($tab['cat'] as $ref => $name) {
					echo "<tr><form action='add_category.php' method='POST'>";
					echo "<td><input type='text' name='name' value='".$name."'></td>";
					echo "<td><input type='submit' name='submit' value='DEL' method='POST' /></td>";
					echo "<td><input type='text' name='ref' value=".$ref." hidden></td></form></tr>";
				}
				echo "<tr><form action='add_category.php' method='POST'>";
				echo "<td><input type='text' name='name' value='' /></td>";
				echo "<td><input type='submit' name='submit' value='OK' method='POST' /></td></form></tr>";
				echo "</table>";
				echo "</div>";
				admin_right();
			} else {
				if (file_put_contents("private/item_corrupt".time(), $content) === FALSE) {
					echo "ERROR\n";
				}
				$tab = array();
			}
		}
	} else {
		login_form($_SERVER['PHP_SELF']);
	}
} else {
	header("Location: install.php");
}
?>
</body></html>
