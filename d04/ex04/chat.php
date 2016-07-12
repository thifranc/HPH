<?PHP
if (file_exists("../private/chat"))
{
	$file = file_get_contents("../private/chat");
	$tab = unserialize($file);
	if ($tab)
	{
		foreach($tab as $elem)
		{
			$hour = date("H:i", $elem['time']);
			echo "[".$hour."] ".$elem['login'].": ".$elem['msg']."<br/>";
		}
	}
}
?>
