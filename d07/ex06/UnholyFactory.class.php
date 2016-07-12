<?PHP
class UnholyFactory
{
	public $warrior = array();
	public function absorb($type)
	{
		if ($type instanceof Fighter)
		{
			if (in_array($type->name, $this->warrior))
				echo "(Factory already absorbed a fighter of type ".$type->name.")\n";
			else
			{
				$this->warrior[get_class($type)] = $type->name;
				echo "(Factory absorbed a fighter of type ".$type->name.")\n";
			}
		}
		else
			echo "(Factory can\"t absorb this, it\"s not a fighter)\n";
	}

	public function fabricate($type)
	{
		if (in_array($type, $this->warrior))
		{
			echo "(Factory fabricates a fighter of type ".$type.")\n";
			$out = array_search($type, $this->warrior);
			return new $out;
		}
		else
			echo "(Factory hasn\"t absorbed any fighter of type ".$type.")\n";
	}
}
?>
