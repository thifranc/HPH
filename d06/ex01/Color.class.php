<?PHP
Class Color
{
	public $red = 0;
	public $blue = 0;
	public $green = 0;
	public static $verbose = False;

	function __construct($tab)
	{
		if (isset($tab['rgb']))
		{
			$this->red = ((int)$tab['rgb'] & 0xFF0000) >> 16;
			$this->green = ((int)$tab['rgb'] & 0x00FF00) >> 8;
			$this->blue = (int)$tab['rgb'] & 0x0000FF;
		}
		else
		{
			$this->red = round((ctype_xdigit($tab['red'])) ? hexdec($tab['red']) : $tab['red']);
			$this->green = round((ctype_xdigit($tab['green'])) ? hexdec($tab['green']) : $tab['green']);
			$this->blue = round((ctype_xdigit($tab['blue'])) ? hexdec($tab['blue']) : $tab['blue']);
			$this->blue = $this->check($this->blue);
			$this->green = $this->check($this->green);
			$this->red = $this->check($this->red);
		}
		if (self::$verbose == True)
			print ("$this constructed" . PHP_EOL);
	}

	function check($num)
	{
		if ($num > 255)
			return (255);
		else if ($num < 0)
			return (0);
		else
			return ($num);
	}

	function __toString()
	{
		return sprintf("Color( red: %3d, green: %3d, blue: %3d )", $this->red, $this->green, $this->blue);
	}

	function add($add)
	{
		if (isset($add))
		{
			$new_red = $this->check($this->red + $add->red);
			$new_green = $this->check($this->green + $add->green);
			$new_blue = $this->check($this->blue + $add->blue);
			$out = new Color(array( 'red' => $new_red, 'green' => $new_green, 'blue' => $new_blue));
		}
		return ($out);
	}

	function sub($sub)
	{
		if (isset($sub))
		{
			$new_red = $this->check($this->red - $sub->red);
			$new_green = $this->check($this->green - $sub->green);
			$new_blue = $this->check($this->blue - $sub->blue);
			$out = new Color(array( 'red' => $new_red, 'green' => $new_green, 'blue' => $new_blue));
		}
		return ($out);
	}

	function mult($mult)
	{
			$new_red = $this->check(round($this->red * $mult));
			$new_green = $this->check(round($this->green * $mult));
			$new_blue = $this->check(round($this->blue * $mult));
		$out = new Color(array( 'red' => $new_red, 'green' => $new_green, 'blue' => $new_blue));
		return ($out);
	}

	function __destruct()
	{
		if (self::$verbose == True)
			print ("$this destructed" . PHP_EOL);
	}

	static function doc()
	{
		if (file_exists("Color.doc.txt"))
			return (file_get_contents("Color.doc.txt"));
		else
			return ("File Color.doc.txt does not exist\n");
	}
}
?>
