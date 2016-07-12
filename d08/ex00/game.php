<?php
include_once('back/Map.class.php'); 
include_once('back/Game.class.php'); 
include_once('back/Player.class.php'); 
include_once('back/FatherOfDespair.class.php'); 
include_once('back/Router.class.php'); 

session_start();

// Game tests
if (!$_SESSION['game'])  {
	$game = new Game();
	$game->player1->draw_ship($game->player1->ship, $game->map);
	$game->player2->draw_ship($game->player2->ship, $game->map);
	$_SESSION['game'] = $game;
	$_SESSION['currPlayer'] = 'player1';
}

Router::listenPost(function ($data) {
	$res = [];
	$game = $_SESSION['game'];
	$player = $_SESSION['currPlayer'];
	if ($data["phase"] == "clean") {
		$_SESSION = array();
		echo json_encode(array("success" => "clean"));
	}
	else if ($data["phase"] == "order") {
		$game->$player->give($game->$player->ship, $data);
		print_r($game->$player->ship);
	}
	else if ($data["phase"] == "move") {
		if ($data["move"] == "forward") {
			$r = $game->$player->move($game->$player->ship, array('move' => 'forward'), $game->map);
		} else if ($data["move"] == "right") {
			$r = $game->$player->move($game->$player->ship, array('move' => 'right'), $game->map);
		} else if ($data["move"] == "left") {
			$r = $game->$player->move($game->$player->ship, array('move' => 'left'), $game->map);
		}
		if ($r) {
			$res["map"] = $game->map->getSpace();
			echo json_encode($res);
		}
	} else if ($data["phase"] == "gun") {

		$player == 'player1' ? $nemesis = 'player2' : $nemesis = 'player1';
		$game->$player->gun($game->$player->ship, $game->map, $game->$nemesis);
		$_SESSION['currPlayer'] = $nemesis;
		$game->tour++;
	} else if ($data["phase"] == "info") {
		$info = [];
		$info["player"] = $player;
		$info["lives"] = $game->$player->ship->lives;
		$info["shield"] = $game->$player->ship->shield;
		echo json_encode($info);
	}
})

?>
