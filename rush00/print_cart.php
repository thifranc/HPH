<?
include("item_form_modif.php");
if (isset($_SESSION["cart"]))
{
	foreach ($_SESSION["cart"]["items"] as $item_ref => $item_cart)
{
	echo "<div class='item_cart'>";
	//echo "<p>".$item_cart["name"]."</p>";
	//echo "<p>".$item_cart["price"]."</p>";
	//echo "<p>".$item_cart["quantity"]."</p>";
//	echo "<p>".$item_cart["sub_total"]."</p>";
	item_form_modif($item_ref, $item_cart, $_SERVER['PHP_SELF']);
	}
	echo "</div>";
	echo "<p>Total : ".$_SESSION["cart"]["total"]."€</p>";
	}
?>
