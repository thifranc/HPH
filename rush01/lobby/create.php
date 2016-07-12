<?php
session_start();
include('register.php');
$ret = register($_POST['login'], $_POST['passwd'], $_POST['submit']);
if ($ret === 1)
  header('Location: lobby.php')
?>
<html>
  <head>
    <title>42style.com</title>
    <link rel="stylesheet" href="create.css"/>
    <meta charset="UTF-8">
  </head>
  <body>
    <div id='regis'>
      <h1 id='tit_crea'>Créer votre compte personnel</h1>
      <form action='create.php' style="text-align: center" method="post">
        Identifiant: <input style='box-shadow: 0px 0px 0px #cccccc inset;' type="text" name='login' value="" /><?php if ($ret < 0) echo " Login déjà utilisé<br />";
        else{ ?><br /><?php } ?>
        Mot de passe: <input style='box-shadow: 0px 0px 0px #cccccc inset;' type="password" name='passwd' value="" /><br />
        <input type="Submit" name='submit' value='Envoyer'/>
      </form>
      <a href="lobby.php">Go back</a>
    </div>
  </body>
</html>
