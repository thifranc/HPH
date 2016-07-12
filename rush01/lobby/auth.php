<?php
session_start();
function auth($login, $passwd)
{
  if (!file_exists("../private/passwd"))
    return 0;
  $str = file_get_contents("../private/passwd");
  $check = unserialize($str);
  $passwd = hash("whirlpool", $passwd);
  foreach ($check as $key => $value)
  {
    if ($check[$key]['passwd'] === $passwd && $check[$key]['login'] === $login)
    {
      $_SESSION['login'] = $login;
      return 1;
    }
  }
  return 0;
}
?>
