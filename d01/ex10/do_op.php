#!/usr/bin/php
<?PHP
	if ($argc != 4)
		exit ("Incorrect Parameters\n");
	if ($argv[2] == "+")
		echo ($argv[1] + $argv[3]);
	if ($argv[2] == "-")
		echo ($argv[1] - $argv[3]);
	if ($argv[2] == "*")
		echo ($argv[1] * $argv[3]);
	if ($argv[2] == "/")
		echo ($argv[1] / $argv[3]);
	if ($argv[2] == "%")
		echo ($argv[1] % $argv[3]);
	echo "\n";
?>
