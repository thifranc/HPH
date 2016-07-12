<?PHP
	abstract class Fighter
	{
		abstract function fight($target);

		public $name;
		function __construct($type)
		{
			$this->name = $type;
		}
	}
	
?>
