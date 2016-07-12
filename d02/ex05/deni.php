#!/usr/bin/php
<?PHP
if ($argc != 3 || !file_exists($argv[1]))
	exit();
$max_tab = array();
$fd = fopen($argv[1], "r");
$line = fgetcsv($fd, "", ";");
foreach	($line as $key => $value)
	$max_tab[$value] = array();
while ($line = fgetcsv($fd, "", ";"))
{
	$i = 0;
	foreach ($max_tab as $key => $val)
		$max_tab[$key][] = $line[$i++];
}
if (!array_key_exists($argv[2], $max_tab))
	exit();
while ($tab = fgetcsv($fd, "", ";"))
{
	array_push($max_tab['nom'], $tab[0]);
	array_push($max_tab['prenom'], $tab[1]);
	array_push($max_tab['mail'], $tab[2]);
	array_push($max_tab['IP'], $tab[3]);
	array_push($max_tab['pseudo'], $tab[4]);
}
$good_tab = $max_tab[$argv[2]];
extract($max_tab);
while (1)
{
	echo "Entrez votre commande: ";
	$cmd = fgets(STDIN);
	if ($cmd == NULL)
		exit("\n");
	else
	{
		$data = array();
		preg_match("/\[\'(.*?)\'\]/", $cmd, $data);
		$tmp = $data[1];
		if (($sub = array_search($tmp, $good_tab)) == FALSE)
			exit ("Input does not match in array\n");
		$final = str_replace($data[0], "[".$sub."]", $cmd);
		eval($final);
	}
}
?>
