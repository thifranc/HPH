<?PHP
class Lannister
{
	public $fuckSister = TRUE;
	function sleepWith($autre)
	{
		if (get_parent_class($autre) != 'Lannister')
			print ("Let's do this.\n");
		else 
		{
			if ($this->fuckSister == TRUE && $autre->fuckSister == TRUE)
				print ("With pleasure, but only in a tower in Winterfell, then.\n");
			else
				print ("Not even if I'm drunk !\n");
		}
	}
}
?>
