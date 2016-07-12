<?PHP
include_once('FatherOfDespair.class.php');
include_once('doc.trait.php'); 

class SpaceshipFactory
{
	use Doc;
	private static $doc_path = 'back/SpaceshipFactory.doc.txt';

    public static function create($type, $id, $position)
	{
		return new $type($id, $position);
	}
}	
?>
