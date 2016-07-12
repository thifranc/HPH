<?php

include_once('doc.trait.php'); 

class Map {
	use Doc;
	private static $doc_path = 'back/Map.doc.txt';

	private $size;
	public $max_X;
	public $max_Y;
	private $obstacles = [];
	public $space = [];

	public function __construct(array $kwargs) {
		if (!isset($kwargs['size'])) {
			throw new Exception('Class Map missing $kwargs["size"].');
		} else if (!isset($kwargs['obstacles'])) {
			throw new Exception('Class Map missing $kwargs["obstacles"].');
		}

		$this->size = $kwargs['size'];
		$this->max_X = $kwargs['max_X'];
		$this->max_Y = $kwargs['max_Y'];
		$this->obstacles = $kwargs['obstacles'];
		for ($y = 0; $y < $kwargs['size'][1]; $y++) {
			for ($x = 0; $x < $kwargs['size'][0]; $x++) {
				$this->space[$x][$y] = ".";
			}
		}
		$this->space[10][10] = '*';
		$this->space[20][20] = '*';
		$this->space[45][45] = '*';
	}

//	public function __get($name) { throw new Exception('You have to use instance.getMap() !'); }
//	public function __set($name, $value) { throw new Exception('The attributes of Map Class is read only !'); }

	public function getSize() { return $this->size; }
	public function getSpace() { return $this->space; }
}
?>
