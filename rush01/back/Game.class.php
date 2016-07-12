<?php

include_once('doc.trait.php');
include_once('back/Map.class.php');
include_once('back/Game.class.php');
include_once('back/Player.class.php');
include_once('back/RollDice.trait.php');
include_once('back/FatherOfDespair.class.php');
include_once('back/SorrowBoy.class.php');
include_once('back/SpaceshipFactory.class.php');

class Game {
	use Doc;
	private static $doc_path = 'back/Game.doc.txt';

	private $turn = 0;
	public $player1;
	public $player2;
	private $currentPlayer;
	public $map;

	public function get_ship_rank($player)
	{
		$rank = 0;
		foreach ($this->$player->armada as $elem)
		{
			if ($elem->active == true)
				return ($rank);
			$rank++;
		}
		return (FALSE);
	}

	public function __construct() {
		$this->map = new Map(array('size' => [75, 50], 'max_X' => 74, 'max_Y' => 49,
			'obstacles' => [[10, 10], [20, 20], [45, 45]]));
		$ship1 = SpaceshipFactory::create('FatherOfDespair', 'a', [45, 20]);
		$ship2 = SpaceshipFactory::create('FatherOfDespair', 'A', [20, 40]);
		$ship3 = SpaceshipFactory::create('SorrowBoy', 'b', [40, 10]);
		$ship4 = SpaceshipFactory::create('SorrowBoy', 'B', [10, 32]);
		$ship5 = SpaceshipFactory::create('SorrowBoy', 'c', [50, 10]);
		$ship6 = SpaceshipFactory::create('SorrowBoy', 'C', [10, 40]);
		$armada1 = array($ship1, $ship3, $ship5);
		$armada2 = array($ship2, $ship4, $ship6);
		$this->player1 = new Player(array('name' => '1', 'ship' => $ship1, 'armada' => $armada1));
		$this->player2 = new Player(array('name' => '2', 'ship' => $ship2, 'armada' => $armada2));
		$this->player1->armada[0]->active();
		$this->player2->armada[0]->active();
	}

	public function ship_cleaner($sh_rank, $id)
	{
		$ct = 0;
		while ($this->player1->armada[$ct])
		{
			if ($this->player1->armada[$ct]->lives <= 0)
			{
				if ($sh_rank == $ct && $id == $this->player1->armada[$ct]->id)
					$sh_rank--;
				unset($this->player1->armada[$ct]);
				$this->player1->armada = array_values($this->player1->armada);
			}
			$ct++;
		}
		$ct = 0;
		while ($this->player2->armada[$ct])
		{
			if ($this->player2->armada[$ct]->lives <= 0)
			{
				if ($sh_rank == $ct && $id == $this->player2->armada[$ct]->id)
					$sh_rank--;
				unset($this->player2->armada[$ct]);
				$this->player2->armada = array_values($this->player2->armada);
			}
			$ct++;
		}
		return ($sh_rank);
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
