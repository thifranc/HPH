<?php
function shop_header($title)
{
	if ($title !== 'Install Shop' && !file_exists("private/passwd")) {
		header("Location: install.php");
	}
	echo '<!doctype html>
<html lang="fr">
	<head>
		<title>'.$title.'</title>
		<link rel="stylesheet" type="text/css" href="shop.css" media="all"/>
		<meta charset="utf-8" />
	</head>';
	}
?>
