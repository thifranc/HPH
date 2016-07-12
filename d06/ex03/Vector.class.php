<?PHP
Class Vector
{
	public static $verbose = False;

	private $_x;
	private $_y;
	private $_z;
	private $_w = 0;

	function __construct($tab)
	{
		if (!isset($tab['dest']))
			exit ("__construct failed because a 'dest' wasn't given at Vector\n");
		else
		{
			$this->_x = (isset($tab['orig'])) ? $tab['dest']->_x - $tab['orig']->_x : $tab['dest']->_x;
			$this->_y = (isset($tab['orig'])) ? $tab['dest']->_y - $tab['orig']->_y : $tab['dest']->_y;
			$this->_z = (isset($tab['orig'])) ? $tab['dest']->_z - $tab['orig']->_z : $tab['dest']->_z;
			$this->_w = (isset($tab['orig'])) ? $tab['dest']->_w - $tab['orig']->_w : $tab['dest']->_w - 1;
		}
		if (self::$verbose == True)
			print ("$this constructed" . PHP_EOL);
	}

	function __toString()
	{
		$out = sprintf("Vector( x: %.2f, y: %.2f, z: %.2f, w: %.2f )", $this->_x, $this->_y, $this->_z, $this->_w);
		return ($out);
	}	

	function __destruct()
	{
		if (self::$verbose == True)
			print ("$this destructed" . PHP_EOL);
	}

	function add(Vector $vector)
	{
		if (!($vector instanceof Vector))
			exit ("Add method failed as vector passed was not instance of vector\n");
		else
		{
			$x = $this->_x + $vector->_x;
			$y = $this->_y + $vector->_y;
			$z = $this->_z + $vector->_z;
			$new = new Vertex ( array( 'x' => $x, 'y' => $y, 'z' => $z));
			$out = new Vector ( array( 'dest' => $new));
			return ($out);
		}
	}

	function __get($var)
	{
		if (isset($this->$var))
			return ($this->$var);
		else
			exit("__get has failes, chexk the var you send to it\n");
	}

	function normalize()
	{
		$long = $this->magnitude();
		$x = $this->_x / $long;
		$y = $this->_y / $long;
		$z = $this->_z / $long;
		$new = new Vertex ( array( 'x' => $x, 'y' => $y, 'z' => $z) );
		$out = new Vector ( array( 'dest' => $new));
		return ($out);
	}

	function sub(Vector $vector)
	{
		if (!($vector instanceof Vector))
			exit ("Sub method failed as vector passed was not instance of vector\n");
		else
		{
			$x = $this->_x - $vector->_x;
			$y = $this->_y - $vector->_y;
			$z = $this->_z - $vector->_z;
			$new = new Vertex ( array( 'x' => $x, 'y' => $y, 'z' => $z));
			$out = new Vector ( array( 'dest' => $new));
			return ($out);
		}
	}

	function opposite()
	{
		$x = -$this->_x;
		$y = -$this->_y;
		$z = -$this->_z;
		$new = new Vertex ( array( 'x' => $x, 'y' => $y, 'z' => $z));
		$out = new Vector ( array( 'dest' => $new));
		return ($out);
	}

	function dotProduct(Vector $vector)
	{
		if (!($vector instanceof Vector))
			exit ("Dot method failed as vector passed was not instance of vector\n");
		else
		{
			$x = $this->_x * $vector->_x;
			$y = $this->_y * $vector->_y;
			$z = $this->_z * $vector->_z;
			$out = $x + $y + $z;
			return ($out);
		}

	}

	function crossProduct(Vector $vecteur)
	{
		$x = $this->_y * $vecteur->_z - $this->_z * $vecteur->_y;
		$y = $this->_z * $vecteur->_x - $this->_x * $vecteur->_z;
		$z = $this->_x * $vecteur->_y - $this->_y * $vecteur->_x;
		$new = new Vertex ( array( 'x' => $x, 'y' => $y, 'z' => $z));
		$out = new Vector ( array( 'dest' => $new));
		return ($out);
	}

	function cos(Vector $vecteur)
	{
		$norm_vec = $vecteur->normalize();
		$norm_me = $this->normalize();
		$out = $norm_me->dotProduct($norm_vec);
		return ($out);
	}

	function scalarProduct($k)
	{
		$x = $this->_x * $k;
		$y = $this->_x * $k;
		$z = $this->_x * $k;
		$new = new Vertex ( array( 'x' => $x, 'y' => $y, 'z' => $z));
		$out = new Vector ( array( 'dest' => $new));
		return ($out);
	}

	function magnitude()
	{
		$out = sqrt(($this->_x * $this->_x) + ($this->_y * $this->_y) + ($this->_z * $this->_z));
		return ($out);
	}

	static function doc()
	{
		if (file_exists("Vector.doc.txt"))
			return (file_get_contents("Vector.doc.txt"));
		else
			return ("File Vector.doc.txt does not exist\n");
	}

}
?>
