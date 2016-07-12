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

if ($_POST['submit'] == "OK" && $_POST['login'] && $_POST['passwd'])
{
	if (!file_exists("../private"))
		mkdir("../private");
	if (file_exists("../private/passwd"))
	{
		$tab = unserialize(file_get_contents("../private/passwd"));
		foreach ($tab as $elem)
			if ($elem['login'] == $_POST['login'])
			{
				header("Location: create.html");
				echo "ERROR\n";
				return (-1);
			}
	}
	$new_account['login'] = $_POST['login'];
	$new_account['passwd'] = hash("whirlpool", $_POST['passwd']);
	$tab[] = $new_account;
	$tmp = serialize($tab);
	file_put_contents("../private/passwd", $tmp);
	header("Location: index.html");
	success();
}
else
{
	header("Location: create.html");
	error();
}
?>
