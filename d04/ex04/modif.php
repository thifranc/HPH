<?PHP
function	error()
{
	echo "Error\n";
	return ;
}

function	success()
{
	echo "Ok\n";
	return ;
}

function	countme($tab)
{
	$i = 0;
	while ($tab[$i])
		$i++;
	return ($i);
}

function	lock_me($file)
{
	if (flock($fp, LOCK_EX))
	{
		file_put_contents("../private/chat", $tmp);
		flock($fd, LOCK_UN);
		fclose($fd);
	}
	else
	{
		$date = time() + 5;
		while (time() != $date)
		{};
		lock_me($new_file);
	}
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
			header("Location: modif.html");
			echo "ERROR\n";
			return (-1);
		}
		else
			$tab[$i]['passwd'] = hash("whirlpool", $_POST['newpw']);
		$tmp = serialize($tab);
		file_put_contents("../private/passwd", $tmp);
		header("Location: index.html");
		success();
	}
	else
	{
		header("Location: modif.html");
		error();
	}
}
else
{
	header("Location: modif.html");
	error();
}
?>
