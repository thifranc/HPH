<?php
function item_form($ref, $item, $action)
{
	echo "<form action='".$action."' method='post'>";
	echo "Article : ".$item['name'].".<br />";
	echo '<html><img src="img/pixels.jpg" width="250" height="75"/></html><br />';
	echo "Prix : ".$item['price']."€.<br />";
	echo "<input type='hidden' name='ref' value='".$ref."'>";
	echo "<input type='hidden' name='form' value='add_to_cart'>";
	echo "Quantite : <input type='number' name='quantity' value='1' max='".$item["number"]."'>";
	echo "<input type='submit' value='Ajouter au panier'>";
 echo "</form>";
	}
?>
