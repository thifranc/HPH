<?php
function user_modifier($new_pwd, $login)
{
$hashed_newpw = hash("whirlpool", $new_pwd);
$unserialized = unserialize(file_get_contents("private/passwd"));
$changed = 0;
foreach ($unserialized as $key => $user)
{
	if ($user["login"] === $login)
	{
			$unserialized[$key]['passwd'] = $hashed_newpw;
			$changed = 1;
	}
}
if ($changed === 1)
{
	$to_put = serialize($unserialized);
	file_put_contents("private/passwd", $to_put);
}
else
{
	echo "ERROR\n";
	return ;
}
echo "OK\n";
}
?>
