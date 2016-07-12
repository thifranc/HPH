<?PHP
function auth($login, $passwd)
{
	if (!file_exists("../private"))
		return (FALSE);
	$file = file_get_contents("../private/passwd");
	$tab = unserialize($file);
	foreach ($tab as $elem)
		if ($elem['login'] == $login && $elem['passwd'] == hash("whirlpool", $passwd))
			return (TRUE);
	return (FALSE);
}
?>
