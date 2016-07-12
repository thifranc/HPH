<?PHP

function add_user($num, $tab, $login, $passwd)
{
	$passwd = hash("whirlpool", $passwd);
	$tab[$num]['passwd'] = $passwd;
	$content = serialize($tab);
	if (file_put_contents("private/passwd", $content)) {
		echo "OK\n";
	} else {
		echo "ERROR\n";
	}
}

if (file_exists("private/passwd") === TRUE) {
	header("Location: modif.html");
	if ($_POST['oldpw'] != NULL && $_POST['newpw'] != NULL && $_POST['login'] != NULL && $_POST['submit'] === "OK") {
		$content = file_get_contents("private/passwd");
		$tab = unserialize($content);
		$i = 0;
		if (is_array($tab)) {
			while (isset($tab[$i])) {
				if ($tab[$i]['login'] === $_POST['login'] && $tab[$i]['passwd'] === hash("whirlpool", $_POST['oldpw'])) {
					break ;
				}
				$i++;
			}
			if (isset($tab[$i]) === TRUE) {
				add_user($i, $tab, $_POST['login'], $_POST['newpw']);
			} else {
				echo "ERROR\n";
			}
		} else {
			echo "ERROR\n";
		}
	} else {
		echo "ERROR\n";
	}
} else {
	header("Location: install.php");
}

?>
