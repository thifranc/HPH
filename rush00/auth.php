<?PHP

function auth($login, $passwd)
{
	if (file_exists("private/passwd") === TRUE) {
		$content = file_get_contents("private/passwd");
		$tab = unserialize($content);
		$i = 0;
		if (is_array($tab)) {
			while (isset($tab[$i])) {
				if ($tab[$i]['login'] === $login && $tab[$i]['passwd'] === hash("whirlpool", $passwd)) {
					break ;
				}
				$i++;
			}
			if (isset($tab[$i]) === TRUE) {
				$ret = array("loggued_on_user" => $login, "is_admin" =>              $tab[$i]['is_admin']);
				if (count($tab[$i]["cart"]))
					$ret["cart"] = $tab[$i]["cart"];
				return ($ret);
			}
		}
	}
	return (array("loggued_on_user" => "", "is_admin" => 0));
}

?>
