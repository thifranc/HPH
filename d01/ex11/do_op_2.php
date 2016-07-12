#!/usr/bin/php
<?PHP
	if ($argc != 2)
		exit ("Incorrect Parameters\n");
	$argv[1] = trim($argv[1]);
	while (strpos($argv[1], "  "))
		$argv[1] = str_replace("  ", " ", $argv[1]);
	if (strpos($argv[1], "*"))
	{
		$tab = explode("*", $argv[1]);
		if (count($tab) != 2 || is_numeric(trim($tab[0])) == FALSE || is_numeric(trim($tab[1])) == FALSE)
			exit ("Syntax Error\n");
		else
			echo ($tab[0] * $tab[1]);
	}
	else if (strpos($argv[1], "+"))
	{
		$tab = explode("+", $argv[1]);
		if (count($tab) != 2 || is_numeric(trim($tab[0])) == FALSE || is_numeric(trim($tab[1])) == FALSE)
			exit ("Syntax Error\n");
		else
			echo ($tab[0] + $tab[1]);
	}
	else if (strpos($argv[1], "-"))
	{
		$tab = explode("-", $argv[1]);
		if (count($tab) != 2 || is_numeric(trim($tab[0])) == FALSE || is_numeric(trim($tab[1])) == FALSE)
			exit ("Syntax Error\n");
		else
			echo ($tab[0] - $tab[1]);
	}
	else if (strpos($argv[1], "%"))
	{
		$tab = explode("%", $argv[1]);
		if (count($tab) != 2 || is_numeric(trim($tab[0])) == FALSE || is_numeric(trim($tab[1])) == FALSE || $tab[1] == 0)
			exit ("Syntax Error\n");
		else
			echo ($tab[0] % $tab[1]);
	}
	else if (strpos($argv[1], "/"))
	{
		$tab = explode("/", $argv[1]);
		if (count($tab) != 2 || is_numeric(trim($tab[0])) == FALSE || is_numeric(trim($tab[1])) == FALSE || $tab[1] == 0)
			exit ("Syntax Error\n");
		else
			echo ($tab[0] / $tab[1]);
	}

	echo "\n";
?>
