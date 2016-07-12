<?PHP
	class NightsWatch
	{
		public $warrior = array();

		function recruit($new)
		{
			$this->warrior[] = $new;
		}

		function fight()
		{
			foreach ($this->warrior as $fighter)
			{
				if ($fighter instanceof Ifighter)
					$fighter->fight();
			}
		}
	}
?>
