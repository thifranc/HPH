<?php
function item_form_modif($ref, $item, $action)
{
	echo "<form action='".$action."' method='post'>";
	echo "<p>Article : ".$item['name']."</p>";
	echo "<p>Prix : ".$item['price']."€</p>";
	echo "<input type='hidden' name='ref' value='".$ref."'>";
	echo "<input type='hidden' name='form' value='modif_cart'>";
	echo "Quantite : <input type='number' name='quantity' value='".$item["quantity"]."' max='".$item["number"]."'>";
	echo "<p>Sous-total : ".$item['sub_total']."€</p>";
	echo "<input type='submit' value='Modifier quantité'>";
 echo "</form>";
	}
?>
