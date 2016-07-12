#!/usr/bin/php
<?PHP
	if ($argc == 1)
		exit ();
	$line = preg_replace("/[ \t]+/", " ", $argv[1]);
	$line = preg_replace("/^ | $/", "", $line);
	echo $line."\n";
?>
