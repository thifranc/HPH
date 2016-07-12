<?php
include_once('doc.trait.php'); 

class Spaceship {
	use Doc;
	private static $doc_path = 'back/Spaceship.doc.txt';

	public $id;
	public $active = false;
	private $basePP;
	private $inertia = 0;

	public $aim = 1;
	public $pos = [];
	public $lives;
	public $shield = 0;
	public $gun = 0;
	public $speed;
	public $last_move;

	private $movable;
	private $range;
	private $gap_x;
	private $gap_y;
	private $max_lives;

	public function __construct(array $kwargs) {

		if (!isset($kwargs['id'])) {
			throw new Exception('Class Spaceship missing $kwargs["id"].');
		} else if (!isset($kwargs['pos'])) {
			throw new Exception('Class Spaceship missing $kwargs["position"].');
		} else if (!isset($kwargs['pp'])) {
			throw new Exception('Class Spaceship missing $kwargs["pp"].');
		} else if (!isset($kwargs['lives'])) {
			throw new Exception('Class Spaceship missing $kwargs["lives"].');
		} else if (!isset($kwargs['gap_x'])) {
			throw new Exception('Class Spaceship missing $kwargs["gap_x"].');
		} else if (!isset($kwargs['gap_y'])) {
			throw new Exception('Class Spaceship missing $kwargs["gap_y"].');
		} else if (!isset($kwargs['range'])) {
			throw new Exception('Class Spaceship missing $kwargs["range"].');
		} else if (!isset($kwargs['movable'])) {
			throw new Exception('Class Spaceship missing $kwargs["movable"].');
		}

	$this->id = $kwargs['id'];
	$this->range = $kwargs['range'];
	$this->gap_x = $kwargs['gap_x'];
	$this->gap_y = $kwargs['gap_y'];
	$this->pos= $kwargs['pos'];
	$this->lives = $kwargs['lives'];
	$this->basePP = $kwargs['pp'];
	$this->movable = $kwargs['movable'];


	$this->last_move = $this->movable;
	$this->max_lives = $this->lives;
}

//public function __get($name) { throw new Exception('You have to use instance.getAttr() !'); }
//public function __set($name, $value) { throw new Exception('You have to use instance.setAttr() !'); }

/*public function getName() { return $this->name; }
public function getSize() { return $this->size; }
public function getPosition() { return $this->position; }
public function getPP() { return $this->currPP; }
public function getLives() { return $this->lives; }
public function getSpeed() { return $this->speed; }
public function getInertia() { return $this->inertia; }

public function shieldUp() { $this->shield++; }
public function shieldDown() { if ($this->shield > 0) $this->shield--; }
public function livesUp() { $this->lives++; }
public function livesDown() { if ($this->lives > 0) $this->lives--; }  */


public function active() { $this->active = true; }
public function desactive() { $this->active = false; }
 

public function getMovable() { return $this->movable; }
public function getRange() { return $this->range; }
public function getGap_x() { return $this->gap_x; }
public function getGap_y() { return $this->gap_y; }
public function getMax_Lives() { return $this->max_lives; }

}
?>
