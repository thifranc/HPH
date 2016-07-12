#!/usr/bin/php
<?PHP
	$i = 1;
	if ($argc == 1)
		exit();
	while ($i < $argc)
	{
		$argv[$i] = trim($argv[$i]);
	    while (strpos($argv[$i], "  "))
			$argv[$i] = str_replace("  ", " ", $argv[$i]);
		if ($argv[$i])
			$tab[$i - 1] = explode(" ", $argv[$i]);
		$i++;
	}
	$i = 2;
	$max_tab = array_merge($tab[0], $tab[1]);
	while ($tab[$i])
	{
		$max_tab = array_merge($max_tab, $tab[$i]);
		$i++;
	}
	sort($max_tab);
	foreach ($max_tab as $elem)
		echo $elem."\n";
?>
