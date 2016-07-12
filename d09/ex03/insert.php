<?php
function get_data($path) {
	if (!file_exists($path)) {
		return array();
	} else {
		$data = file_get_contents($path);
		return unserialize($data);
	}
}

function add_todo($todo) {
	$data = get_data("list.csv");
	$id = 0;
	foreach ($data as $d) {
		if ($d[1] == $todo) {
			return ;
		}
		$id = $d[0];
	}
	array_push($data, array($id + 1, $todo));
	file_put_contents("list.csv", serialize($data));
}
add_todo($_GET["todo"]);

header('Content-Type: application/json');
echo json_encode(get_data("list.csv"));
?>
