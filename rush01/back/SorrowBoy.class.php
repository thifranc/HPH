<?php
include_once('Spaceship.class.php'); 
include_once('doc.trait.php'); 

class SorrowBoy extends Spaceship {
	use Doc;
	private static $doc_path = 'back/SorrowBoy.doc.txt';

	public function __construct($id, $position) {
		parent::__construct(array(
			'id' => $id, 'pos' => $position,
			'lives' => 4, 'pp' => 50, 'movable' => 2,
			'gap_x' => 1, 'gap_y' => 0, 'range' => 5
			));
		}
}
?>
