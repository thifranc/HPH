<?php
function get_data($path) {
	if (!file_exists($path)) {
		return array();
	} else {
		$data = file_get_contents($path);
		return unserialize($data);
	}
}

$data = get_data('list.csv');
header('Content-Type: application/json');
echo json_encode($data);
