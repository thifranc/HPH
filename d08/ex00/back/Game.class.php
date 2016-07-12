<?php

include_once('doc.trait.php'); 
include_once('back/Map.class.php');
include_once('back/Game.class.php');
include_once('back/Player.class.php');
include_once('back/RollDice.trait.php');
include_once('back/FatherOfDespair.class.php');
include_once('back/SpaceshipFactory.class.php');

class Game {
	use Doc;
	private static $doc_path = 'back/Game.doc.txt';

	private $turn = 0;
	public $player1;
	public $player2;
	private $currentPlayer;
	public $map;

	public function __construct() {
		$this->map = new Map(array('size' => [75, 50], 'max_X' => 74, 'max_Y' => 49,
			'obstacles' => [[10, 10], [20, 20], [45, 45]]));
		$ship_low = SpaceshipFactory::create('FatherOfDespair', 'a', [15, 15]);
		$ship_up = SpaceshipFactory::create('FatherOfDespair', 'A', [30, 30]);
		$this->player1 = new Player(array('name' => '1', 'ship' => $ship_low));
		$this->player2 = new Player(array('name' => '2', 'ship' => $ship_up));
	}

//	public function __get($name) { throw new Exception('You have to use instance.getAttr() !'); }
//	public function __set($name, $value) { throw new Exception('You have to use instance.setAttr() !'); }

	public function displayMap() {
		for ($y = 0; $y < $this->map->getSize()[1]; $y++) {
			for ($x = 0; $x < $this->map->getSize()[0]; $x++) {
				echo $this->map->getSpace()[$x][$y];
			}
			echo "\n";
		}
		echo "\n\n";
	}
}
?>
