<?php
function get_data($path) {
	if (!file_exists($path)) {
		return array();
	} else {
		$data = file_get_contents($path);
		return unserialize($data);
	}
}

function delete_todo($todo) {
	$data = get_data("list.csv");
	$id = 0;

	for ($i = 0; $i < count($data); $i++) {
		if ($data[$i][1] == $todo) {
			unset($data[$i]);
		}
	}
	$data = array_values($data);
	file_put_contents("list.csv", serialize($data));
}
delete_todo($_GET["todo"]);

header('Content-Type: application/json');
echo json_encode(get_data("list.csv"));
?>
