<?PHP

require_once 'Color.class.php';

Class Vertex
{
	private $_x;
	private $_y;
	private $_z;
	private $_w = 1.0;
	private $_color;
	public static $verbose = False;

	function __construct($tab)
	{
		if (!isset($tab['x']) || !isset($tab['y']) || !isset($tab['z']))
			exit ('Vertex is not well sent, check X Y and Z values please\n');
		else
		{
			$this->_x = $tab['x'];
			$this->_y = $tab['y'];
			$this->_z = $tab['z'];
			if (isset($tab['w']))
				$this->_w = $tab['w'];
			if (isset($tab['color']) && ($tab['color'] instanceof Color))
				$this->_color = $tab['color'];
			else
				$this->_color = new Color( array('rgb' => 0xFFFFFF));
			if (self::$verbose == True)
				print ("$this constructed" . PHP_EOL);
		}
	}

	function __get($var)
	{
		if (isset($this->$var))
			return ($this->$var);
		else
			exit ("Error came from __get badly called, check your value passed to __get\n");
	}

	function __set($var, $value)
	{
		if ($var == "Color" && !($this->$var instanceof Color))
			exit ("Arg passed as color is not an instance of color\n");
		if (isset($this->$var))
			$this->$var = $value;
		else
			exit ("Error came from __set badly called, check your value passed to __set\n");
	}

	function __toString()
	{
		$out = sprintf("Vertex( x: %.2f, y: %.2f, z: %.2f, w: %.2f", $this->_x, $this->_y, $this->_z, $this->_w);
		if (self::$verbose)
			$out = $out . ", " . $this->_color;
		return ($out . " )");
	}

	function __destruct()
	{
		if (self::$verbose == True)
			print ("$this destructed" . PHP_EOL);
	}

	static function doc()
	{
		if (file_exists("Vertex.doc.txt"))
			return (file_get_contents("Vertex.doc.txt"));
		else
			return ("File Vertex.doc.txt does not exist\n");
	}
}
?>
