#!/usr/bin/php
<?PHP
while (1)
{
	echo "Entrez un nombre: ";
	$line = fgets(STDIN);
	if ($line == NULL)
		exit ("\n");
	$line = trim($line);
	if (is_numeric($line) == FALSE)
		echo "'".$line."' n'est pas un chiffre\n";
	else
	{
		echo "Le chiffre ".$line." est ";
		if ($line % 2 == 0)
			echo "Pair\n";
		else
			echo "Impair\n";
	}
}
?>
