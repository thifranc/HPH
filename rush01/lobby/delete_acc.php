<?php
session_start();
function delete_acc($log)
{
  if (!$log)
    return 0;
  if (!file_exists("../private/passwd"))
    return 0;
  $check = file_get_contents("../private/passwd");
  $check = unserialize($check);
  foreach ($check as $elem => $value)
  {
    if ($value['login'] === $log)
    {
      unset($check[$elem]);
      $str = serialize($check);
      file_put_contents("../private/passwd", $str);
      unset($_SESSION['login']);
      return 1;
    }
  }
}
delete_acc($_SESSION['login']);
header('Location: lobby.php');
?>
