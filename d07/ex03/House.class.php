<?PHP
abstract class House
{
	abstract function getHouseName();
	abstract function getHouseMotto();
	abstract function getHouseSeat();

	function introduce()
	{
		echo "House ".$this->getHouseName()." of ".$this->getHouseSeat()." : \"".$this->getHouseMotto()."\"\n";
	}
}
?>
