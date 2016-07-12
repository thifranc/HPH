<?php
include("item_form.php");

	if (file_exists("private/item"))
	{
	$tab = unserialize(file_get_contents("private/item"));
	if (is_array($tab) && is_array($tab["item"]) && is_array($tab["cat"]))
	{
		$cat = $tab["cat"];
		$items = $tab["item"];

		foreach ($items as $key => $item)
		{
		if (!isset($_SESSION["category"]) || in_array($_SESSION["category"], $item["cat"]))
item_form($key, $item, $_SERVER['PHP_SELF']);
		}
	}
	}

?>
