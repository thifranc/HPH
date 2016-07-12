<?php
function modif($submit, $oldpw, $newpw, $log)
{
  if ($submit === "OK")
  {
    if (!$log || !$oldpw || !$newpw)
      return 0;
    if (!file_exists("../private/passwd"))
    {
      return 0;
    }
    $check = file_get_contents("../private/passwd");
    $check = unserialize($check);
    foreach ($check as $elem => $value)
    {
      if ($value['login'] === $log)
      {
        if ($value['passwd'] === hash("whirlpool", $oldpw))
        {
          $check[$elem]['passwd'] = hash("whirlpool", $newpw);
          $str = serialize($check);
          file_put_contents("../private/passwd", $str);
          return 1;
        }
      }
    }
  }
}
$verif = modif($_POST['submit'], $_POST['oldpw'], $_POST['newpw'], $_POST['login']);
if ($verif === 1)
  header('Location: lobby.php');
?>
<html>
  <head>
    <title>42style.com</title>
    <link rel="stylesheet" href="create.css"/>
    <meta charset="UTF-8">
  </head>
  <body>
    <div id='regis'>
      <h1 id='tit_crea'>Modifier mon mot de passe</h1>
      <form action='modif.php' style="text-align: center" method="post">
        Identifiant: <input style='box-shadow: 0px 0px 0px #cccccc inset;' type="text" name='login' value="" /><br />
        Ancien mot de passe: <input style='box-shadow: 0px 0px 0px #cccccc inset;' type="password" name='oldpw' value="" /><br />
        Mot de passe: <input style='box-shadow: 0px 0px 0px #cccccc inset;' type="password" name='newpw' value="" /><br />
        <input type="Submit" name='submit' value='OK'/>
      </form>
      <a href="lobby.php">Go back</a>
    </div>
  </body>
</html>
