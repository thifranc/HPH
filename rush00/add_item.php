<?php

function add_item($tab, $POST) {
	$tab['item'][$POST['ref']]['name'] = $POST['name'];
	$tab['item'][$POST['ref']]['price'] = $POST['price'];
	$tab['item'][$POST['ref']]['number'] = $POST['number'];
	if (isset($tab['item'][$POST['ref']]['sold']) === FALSE) {
		$tab['item'][$POST['ref']]['sold'] = 0;
	}
	$tab['item'][$POST['ref']]['cat'] = array();
	foreach($tab['cat'] as $ref_cat => $val) {
		if (array_key_exists($ref_cat, $POST)) {
			$tab['item'][$POST['ref']]['cat'][] = $ref_cat;
		}
	}
	$content = serialize($tab);
	if (file_put_contents("private/item", $content) === FALSE) {
		echo "ERROR\n";
	}
}

function del_item($tab, $ref) {
	$new = array();
	$i = 0;
	while ($i < count($tab['item'])) {
		if ($i != $ref) {
			$new[] = $tab['item'][$i];
		}
		$i++;
	}
	$tab['item'] = $new;
	$content = serialize($tab);
	if (file_put_contents("private/item", $content) === FALSE) {
		echo "ERROR file_put_contents del\n";
	}
}

header("Location: item.php");

if ($_POST['name'] != NULL && $_POST['price'] != NULL && $_POST['number'] != NULL && $_POST['submit'] === "OK") {
	if (file_exists('private/item') === FALSE) {
		$tab = array('cat' => array(), 'item' => array());
		$_POST['ref'] = 0;
	} else {
		$tab = unserialize(file_get_contents("private/item"));
		if (is_array($tab)) {
			if (isset($_POST['ref']) === FALSE)
				$_POST['ref'] = count($tab['item']);
		} else {
			if (file_put_contents("private/item_corrupt".time(), $content) === FALSE) {
				echo "ERROR\n";
			}
			$tab = array('cat' => array(), 'item' => array());
			$_POST['ref'] = 0;
		}
		add_item($tab, $_POST);
	}
} else if (isset($_POST['ref']) && $_POST['submit'] === 'DEL') {
	if (file_exists('private/item') === TRUE) {
		$tab = unserialize(file_get_contents("private/item"));
		if (is_array($tab)) {
			del_item($tab, $_POST['ref']);
		}
	}
}

?>
