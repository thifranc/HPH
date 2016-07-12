<?php

function add_cat($tab, $POST) {
	$tab['cat'][$POST['ref']] = $POST['name'];
	if (file_put_contents("private/item", serialize($tab)) === FALSE) {
		echo "ERROR\n";
	}
}

function del_cat($tab, $ref) {
	$new = array();
	$i = 0;
	while ($i < count($tab['cat'])) {
		if ($i != $ref) {
			$new[] = $tab['cat'][$i];
		}
		$i++;
	}
	$tab['cat'] = $new;
	$j = 0;
	while ($j < count($tab['item'])) {
		$i = 0;
		$new_cat = array();
		while ($i < count($tab['item'][$j]['cat'])) {
			if ($tab['item'][$j]['cat'][$i] < $ref) {
				$new_cat[] = $tab['item'][$j]['cat'][$i];
			} else if ($item['cat'][$i] > $ref) {
				$new_cat[] = $tab['item'][$j]['cat'][$i] - 1;
			}
			$i++;
		}
		$tab['item'][$j]['cat'] = $new_cat;
		$j++;
	}
	if (file_put_contents("private/item", serialize($tab)) === FALSE) {
		echo "ERROR file_put_contents del";
	}
}

header('Location: item.php');

if ($_POST['name'] != NULL && $_POST['submit'] === "OK") {
	if (file_exists('private/item') === FALSE) {
		$tab = array('cat' => array(), 'item' => array());
		$_POST['ref'] = 0;
	} else {
		$tab = unserialize(file_get_contents("private/item"));
		if (is_array($tab)) {
			if (isset($_POST['ref']) === FALSE)
				$_POST['ref'] = count($tab['cat']);
		} else {
			if (file_put_contents("private/category_corrupt".time(), $content) === FALSE) {
				echo "ERROR\n";
			}
			$tab = array('cat' => array(), 'item' => array());
			$_POST['ref'] = 0;
		}
		add_cat($tab, $_POST);
	}
} else if (isset($_POST['ref']) && $_POST['submit'] === 'DEL') {
	if (file_exists('private/item') === TRUE) {
		$tab = unserialize(file_get_contents("private/item"));
		if (is_array($tab)) {
			del_cat($tab, $_POST['ref']);
		}
	}
}

?>
