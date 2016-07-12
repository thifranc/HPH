#!/usr/bin/php
<?PHP
	if ($argc != 2)
		exit();
	$argv[1] = trim($argv[1]);
	while (strpos($argv[1], "  "))
		$argv[1] = str_replace("  ", " ", $argv[1]);
	echo $argv[1]."\n";
?>
