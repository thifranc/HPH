#!/usr/bin/php
<?PHP
	if ($argc == 1)
		exit ();
	$tab = explode(" ", $argv[1]);
	$tab = array_filter($tab);
	$tab = array_slice($tab, 0);
	$i = 1;
	while ($i < count($tab))
	{
		echo $tab[$i]." ";
		$i++;
	}
	echo $tab[0]."\n";
?>
