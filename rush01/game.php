<?php
session_start();
if (!$_SESSION['login'])
  header('Location: lobby/lobby.php')
?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Awesome Starships Battles In The Dark Grim Futur Of The Grim Dark 41st Millenium</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css">
    </head>
    <body>
    <div class="container">
      <table id="cell-grid"></table>
    </div>

    <div class="container">
    <div id="controls-container">
      <h2><span id="player"></span> vie: <span id="lives"></span> shield <span id="shield"></span></h2>
      <h2>Turn <span id="turn-number"></span></h2>
      <h2>Phase <span id="phase"></span></h2>
    <div>
      <div id="order">
        <h2>Order</h2>
        <input id="ppAttack" type="number" name="quantity" value="0"> Attack<br>
        <input id="ppSpeed" type="number" name="quantity" value="0"> Speed<br>
        <input id="ppRepair" type="number" name="quantity" value="0"> Repair<br>
        <input id="ppShield" type="number" name="quantity" value="0"> Shield<br>
        <input id="submitOrder" type="submit" value="Ordonner">
    </div>
      <div id="moveActions">
        <h2>Move</h2>
        <button id="forward">Avancer</button>
        <button id="right">Tourner a gauche</button>
        <button id="left">Tourner a droite</button>
    </div>

      <div id="fireAction">
        <h2>Fire</h2>
        <input id="fire" type="submit" value="Tirer / Fin de tour">
    </div>
    <br>
    <br>
    <br>
    <button id="reset">Reset</button>
    <div id="dialog" title="Info">
      <ul>
        <li>Motif: <span id="motif"></span></li>
        <li>Aim: <span id="aim"></span></li>
        <li>Lives: <span id="mlives"></span></li>
        <li>Shield: <span id="mshield"></span></li>
        <li>Last move: <span id="lastMove"></span></li>
      </ul>
      </div>
    </div>
      <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
      <script   src="https://code.jquery.com/ui/1.12.0-rc.2/jquery-ui.min.js"   integrity="sha256-55Jz3pBCF8z9jBO1qQ7cIf0L+neuPTD1u7Ytzrp2dqo="   crossorigin="anonymous"></script>
      <script src="front/call.js"></script>
      <script src="front/main.js"></script>
      <script src="front/events.js"></script>
      <script src="front/shipmodal.js"></script>
    </body>
</html>
