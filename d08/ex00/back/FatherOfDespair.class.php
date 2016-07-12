<?php
include_once('Spaceship.class.php'); 
include_once('doc.trait.php'); 

class FatherOfDespair extends Spaceship {
	use Doc;
	private static $doc_path = 'back/FatherOfDespair.doc.txt';

	public function __construct($id, $position) {
		parent::__construct(array(
			'id' => $id, 'size' => [1, 3], 'pos' => $position,
			'lives' => 8, 'pp' => 50, 'speed' => 10, 'movable' => 2,
			'shield' => 0
			));
		}
}
?>
