<?php
include_once ('../handle_state.php');

session_start();
date_default_timezone_set("Europe/Paris");
include("auth.php");
if (!$_SESSION['login']) {
  auth($_POST['login'], $_POST['passwd']);
}
?>
<html>
  <head>
    <title>Awesome Starships Battles II</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="lobby.css"/>
    <script>
    setInterval(function() {location = 'lobby.php'; }, 20000);
    </script>
  </head>
  <body>
    <header>
      <div class="title">
        <h1>Awesome Starships Battles II<?php if ($_SESSION['login']){ ?>
        <span style='margin-left: 50px; font-family: comic sans ms; font-size: 20px; font-weight:normal;'><?php echo($_SESSION['login']); ?>
        </span><?php } ?></h1>
      </div>
        <?php if ($_SESSION['login']){ ?>
        <div id="log">
          <form class='head' action='lobby.php' style="text-align: center" method="post">
            <input type='button' onclick="self.location.href='./log_out.php'" value="Se déconnecter">
            <input type='button' onclick="self.location.href='./modif.php'" value="Changer mon mot de passe">
            <input type='button' onclick="self.location.href='./delete_acc.php'" value="Supprimer son compte">
          </form>
        </div>
        <?php }else{ ?>
          <div id="delog">
            <form class='head' action='lobby.php' style="text-align: center" method="post">
              Identifiant: <input style='margin-right: 10px; box-shadow: 0px 0px 0px #cccccc inset;' type="text" name='login' value="" />
              Mot de passe: <input style='margin-right: 10px; box-shadow: 0px 0px 0px #cccccc inset;' type="password" name='passwd' value="" />
              <input type="Submit" name='submit' value='OK'/>
              <span id='sep'>|</span>
              <input type='button' onclick="self.location.href='./create.php'" value="S'enregistrer">
            </form>
          </div>
        <?php } ?>
      </header>
      <?php if ($_SESSION['login']){ ?>
        <div id='globale'>
          <div id='games'>

            <?php
            function get_game2() {
              if (!file_exists('../private/game')) {
              		return array();
              }
              else {
              	$data = file_get_contents('../private/game');
              	return unserialize($data);
              }
            }
            $game = get_game2();
            $curr_player = $_SESSION['login'];
            if (!isset($game['users'])) {
              echo "Waiting for 2 players";
              echo ("<a href='../api.php?join=".$curr_player."'>Rejoindre</a>");
            }
            else if (count($game['users']) === 1) {
              echo "Waiting for 1 players";
              printf("<a href='../api.php?join=%s'>Rejoindre</a>", $curr_player);
            }
            else {
              echo '<a href="../api.php?start=true">Play</a>';
            }
            ?>

          </div>
          <div id='block_chat'>
            <iframe name="chat" src="chat.php" id="chat"></iframe>
            <iframe src="speak.php" id="speak"></iframe>
            <script>
            window.setInterval("reloadIFrame();", 3000);
            function reloadIFrame() {
              document.getElementById('chat').contentWindow.location.reload();
            }
            </script>
          </div>
        </div>
        <?php } ?>
    </body>
</html>
