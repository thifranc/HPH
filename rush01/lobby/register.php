<?php
session_start();
function register($log, $pwd, $submit)
{
	if ($submit === "Envoyer")
	{
		if (!$log || !$pwd)
			return 0;
		if (!file_exists('../private'))
			mkdir("../private");
		if (file_exists('../private/passwd'))
		{
			$check = file_get_contents("../private/passwd");
			$check = unserialize($check);
		}
		$pass = hash("whirlpool", $pwd);
		if (!$check)
			$check = array(array('login'=>$log, 'passwd'=>$pass));
		else
		{
			foreach($check as $value)
			{
				foreach($value as $key => $login)
				{
					if ($key === 'login')
					{
						if ($login === $log)
						{
							return -1;
						}
					}
				}
			}
			$check[] = array('login'=>$log, 'passwd'=>$pass);
		}
		$str = serialize($check);
		file_put_contents("../private/passwd", $str);
		$_SESSION['login'] = $log;
    return 1;
	}
	else
	{
		return 0;
	}
}
?>
