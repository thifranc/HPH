<?PHP
function	countme($tab)
{
	$i = 0;
	while ($tab[$i])
		$i++;
	return ($i);
}

if ($_POST['submit'] == "OK" && $_POST['login'] && $_POST['oldpw'] && $_POST['newpw'])
{
	if (file_get_contents("../private/passwd"))
	{
		$tab = unserialize(file_get_contents("../private/passwd"));
		$i = 0;
		while ($i < countme($tab) && $tab[$i]['login'] != $_POST['login'])
			$i++;
		if ($i == countme($tab) || $tab[$i]['passwd'] != hash("whirlpool", $_POST['oldpw']))
		{
			echo "ERROR\n";
			return (-1);
		}
		else
			$tab[$i]['passwd'] = hash("whirlpool", $_POST['newpw']);
		$tmp = serialize($tab);
		file_put_contents("../private/passwd", $tmp);
		echo "OK\n";
	}
	else
		echo "ERROR\n";
}
else
	echo "ERROR\n";
?>
