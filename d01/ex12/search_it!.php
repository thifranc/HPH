#!/usr/bin/php
<?PHP
	$i = 2;
	if ($argc == 1)
		exit ();
	$tab = array();
	while ($i < $argc)
	{
		$tmp = explode(":", $argv[$i]);
		$tab[$tmp[0]] = $tmp[1];
		$i++;
	}
	if ($tab[$argv[1]])
		echo $tab[$argv[1]]."\n";
?>
