<?php
session_start();
function save_game($obj) {
  $save = serialize($obj);
  $data = get_game();
  $data['game'] = $save;
  file_put_contents("./private/game", serialize($data));
}
function set_game() {
  $data = get_game();
  $game = unserialize($data['game']);
  $_SESSION['game'] = $game;
}
function get_game() {
  if (!file_exists('./private/game')) {
  		return array();
  	} else {
  		$data = file_get_contents('./private/game');
      $out = unserialize($data);
  		return ($out);
  	}
  }
function init_log($player) {
  if (!isset($player)) {
		return ;
	}
	$game = get_game();
  if (!isset($game['users'])) {
    $game['users'][] = $player;
  }
  else if (count($game['users']) === 1) {
    if ($game['users'][0] == $player)
      return ;
    array_push($game['users'], $player);
  }
  else {
    echo ("U're too many");
  }
	file_put_contents("./private/game", serialize($game));
}
?>
