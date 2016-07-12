<?PHP
Class Matrix
{
	public static $verbose = False;
	private $matrix = Array();
	private $Vec0;
	private $Vec1;
	private $Vec2;
	private $Vec3;

	const IDENTITY = 'IDENTITY';

	const PROJECTION = 'PROJECTION';

	const TRANSLATION = "TRANSLATION";

	const SCALE = "SCALE";

	const RZ = "RZ";

	const RX = "RX";

	const RY = "RY";

	private function input_check($tab)
	{
		$cst = array(self::IDENTITY, self::TRANSLATION, self::SCALE, self::RX, self::RY, self::RZ, self::PROJECTION);
		if (!in_array($tab['preset'], $cst))
			exit ("Your 'preset' value is wrong\n");
		else
		{
			if ($tab['preset'] == 'SCALE' && !$tab['scale'])
				exit ("Scale awaits for a scaling value entered as 'scale'\n");
			else if ($tab['preset'] == 'TRANSLATION' && !$tab['vtc'])
				exit ("Translate awaits for a translation value entered as 'vtc'\n");
			else if (($tab['preset'] == 'RX' || $tab['preset'] == 'RY' || $tab['preset'] == 'RZ') && !$tab['angle'])
				exit ("Rotation, X, Y or Z awaits for an angle entered as 'angle'\n");
			else if ($tab['preset'] == 'PROJECTION' && (!$tab['fov'] || !$tab['ratio'] || !$tab['near'] || !$tab['far']))
				exit ("Projection awaits for 4 values, use doc function to see the usage\n");
		}
	}

	private function vertexFactory($tab)
	{
		$out = array();
		foreach ($tab as $el)
		{
			if (isset($el[4]))
				$out[] = new Vertex ( array ( 'x' => $el[0], 'y' => $el[1], 'z' => $el[2], 'w' => $el[3], 'color' => $el[4]) );
			else
				$out[] = new Vertex ( array ( 'x' => $el[0], 'y' => $el[1], 'z' => $el[2], 'w' => $el[3]) );
		}
		return ($out);
	}


	private function create_matrix($tab)
	{
		$count = '0';
		foreach ($tab as $el)
		{
			$name = 'Vec'.$count;
			$this->$name = new Vector ( array ( 'dest' => $el ) );
			$this->matrix[$count] = $this->$name;
			$count++;
			// BONUS PEUT ETRE AJOUTER UNE ORIG OPTIONNELLE
		}
	}

	function __construct($tab)
	{
		$this->input_check($tab);

		if ($tab['preset'] == self::IDENTITY)
		{
			$vertex_tab = $this->vertexFactory(array (
				array (1.0, 0.0, 0.0, 1.0),
				array (0.0, 1.0, 0.0, 1.0),
				array (0.0, 0.0, 1.0, 1.0),
				array (0.0, 0.0, 0.0, 2.0),
			));
		}

		if ($tab['preset'] == self::TRANSLATION)
		{
			$vertex_tab = $this->vertexFactory(array (
				array (1.0, 0.0, 0.0, 1.0),
				array (0.0, 1.0, 0.0, 1.0),
				array (0.0, 0.0, 1.0, 1.0),
				array ($tab['vtc']->_x, $tab['vtc']->_y, $tab['vtc']->_z, 2.0),
			));
		}

		if ($tab['preset'] == self::SCALE)
		{
			$sk = $tab['scale'];
			$vertex_tab = $this->vertexFactory(array (
				array ($sk, 0.0, 0.0, 1.0),
				array (0.0, $sk, 0.0, 1.0),
				array (0.0, 0.0, $sk, 1.0),
				array (0.0, 0.0, 0.0, 2.0),
			));
		}

		if ($tab['preset'] == self::RX)
		{
			$a = $tab['angle'];
			$vertex_tab = $this->vertexFactory(array (
				array (1.0, 0.0, 0.0, 1.0),
				array (0.0, cos($a), sin($a), 1.0),
				array (0.0, -sin($a), cos($a), 1.0),
				array (0.0, 0.0, 0.0, 2.0),
			));
		}
	
		if ($tab['preset'] == self::RY)
		{
			$a = $tab['angle'];
			$vertex_tab = $this->vertexFactory(array (
				array (cos($a), 0.0, -sin($a), 1.0),
				array (0.0, 1.0, 0.0, 1.0),
				array (sin($a), 0.0, cos($a), 1.0),
				array (0.0, 0.0, 0.0, 2.0),
			));
		}

		if ($tab['preset'] == self::RZ)
		{
			$a = $tab['angle'];
			$vertex_tab = $this->vertexFactory(array (
				array (cos($a), sin($a), 0.0, 1.0),
				array (-sin($a), cos($a), 0.0, 1.0),
				array (0.0, 0.0, 1.0, 1.0),
				array (0.0, 0.0, 0.0, 2.0),
			));
		}

		if ($tab['preset'] == self::PROJECTION)
		{
			$fov = $tab['fov'];
			$ratio = $tab['ratio'];
			$near = $tab['near'];
			$far = $tab['far'];
			$vertex_tab = $this->vertexFactory(array (
				array (1.0, 0.0, 0.0, 1.0),
				array (0.0, 1.0, 0.0, 1.0),
				array (0.0, 0.0, 1.0, 1.0),
				array (0.0, 0.0, 0.0, 2.0),
			));
		}

		if ($vertex_tab);
			$this->create_matrix($vertex_tab);

		if (self::$verbose == True)
			print ("Matrix instance constructed" . PHP_EOL);
	}

	private function get_tab($rank)
	{
		$out = Array();

		if ($rank == 0)
			$base = '_x';
		else if ($rank == 1)
			$base = '_y';
		else if ($rank == 2)
			$base = '_z';
		else if ($rank == 3)
			$base = '_w';

		$out[] = $this->matrix[0]->$base;
		$out[] = $this->matrix[1]->$base;
		$out[] = $this->matrix[2]->$base;
		$out[] = $this->matrix[3]->$base;
		return ($out);
	}
	
	private function sum_vector($tab, $vector)
	{
		return ($tab[0] * $vector->_x + $tab[1] * $vector->_y + $tab[2] * $vector->_z + $tab[3] * $vector->_w);
	}

	public function mult($mat)
	{
		$out = new Matrix( array( 'preset' => self::IDENTITY ) );

		$out->matrix[0] = new Vector( array ('dest' => new Vertex (array ( 
		
		'x' => $this->sum_vector($this->get_tab(0), $mat->matrix[0]),
		'y' => $this->sum_vector($this->get_tab(1), $mat->matrix[0]),
		'z' => $this->sum_vector($this->get_tab(2), $mat->matrix[0]),
		'w' => $this->sum_vector($this->get_tab(3), $mat->matrix[0]) ) ) ) );

		$out->matrix[1] = new Vector( array ('dest' => new Vertex (array ( 
		
		'x' => $this->sum_vector($this->get_tab(0), $mat->matrix[1]),
		'y' => $this->sum_vector($this->get_tab(1), $mat->matrix[1]),
		'z' => $this->sum_vector($this->get_tab(2), $mat->matrix[1]),
		'w' => $this->sum_vector($this->get_tab(3), $mat->matrix[1]) ) ) ) );

		$out->matrix[2] = new Vector( array ('dest' => new Vertex (array ( 
		
		'x' => $this->sum_vector($this->get_tab(0), $mat->matrix[2]),
		'y' => $this->sum_vector($this->get_tab(1), $mat->matrix[2]),
		'z' => $this->sum_vector($this->get_tab(2), $mat->matrix[2]),
		'w' => $this->sum_vector($this->get_tab(3), $mat->matrix[2]) ) ) ) );

		$out->matrix[3] = new Vector( array ('dest' => new Vertex (array ( 
		
		'x' => $this->sum_vector($this->get_tab(0), $mat->matrix[3]),
		'y' => $this->sum_vector($this->get_tab(1), $mat->matrix[3]),
		'z' => $this->sum_vector($this->get_tab(2), $mat->matrix[3]),
		'w' => $this->sum_vector($this->get_tab(3), $mat->matrix[3]) ) ) ) );

		return ($out);
	}

	function __toString()
	{
		$out0 = sprintf("M | vtcX | vtcY | vtcZ | vtxO\n-----------------------------\n");
		$out1 = sprintf("x | %.2f | %.2f | %.2f | %.2f\n", $this->matrix[0]->_x, $this->matrix[1]->_x, $this->matrix[2]->_x, $this->matrix[3]->_x);
		$out2 = sprintf("y | %.2f | %.2f | %.2f | %.2f\n", $this->matrix[0]->_y, $this->matrix[1]->_y, $this->matrix[2]->_y, $this->matrix[3]->_y);
		$out3 = sprintf("x | %.2f | %.2f | %.2f | %.2f\n", $this->matrix[0]->_z, $this->matrix[1]->_z, $this->matrix[2]->_z, $this->matrix[3]->_z);
		$out4 = sprintf("w | %.2f | %.2f | %.2f | %.2f\n", $this->matrix[0]->_w, $this->matrix[1]->_w, $this->matrix[2]->_w, $this->matrix[3]->_w);
		return $out0 . $out1 . $out2 . $out3 . $out4;
	}	

	function __destruct()
	{
		if (self::$verbose == True)
			print ("Matrix instance destructed" . PHP_EOL);
	}

	function __get($var)
	{
		if (isset($this->$var))
			return ($this->$var);
		else
			exit("__get has failed, check the var you send to it\n");
	}

	static function doc()
	{
		if (file_exists("Matrix.doc.txt"))
			return (file_get_contents("Matrix.doc.txt"));
		else
			return ("File Matrix.doc.txt does not exist\n");
	}
}
?>
