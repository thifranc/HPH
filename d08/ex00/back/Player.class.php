<?PHP

include_once('RollDice.trait.php');
include_once('doc.trait.php'); 

class Player {
	use Doc;
	private static $doc_path = 'back/Player.doc.txt';
	//map et pos sont put as [X][Y]

	use RollDice;

	private $name;
	public $ship;

	function __construct($kwargs)
	{
		$this->name = $kwargs['name'];
		$this->ship = $kwargs['ship'];
	}


	public function gun($ship, $map, $nemesis)//prend armada ennemie normalement
	{
		$msg = array();
		if (!$ship->gun)
		{
			echo json_encode(array("message" => "You don't havy any ammo left, reload comrade !\n"));
			return ;
		}
		if (($this->hay_target($ship, $map->space, $nemesis) != 1))//get target name normaly
		{
			echo json_encode(array("message" => "You can't reach anything, you lose your PP stupidly\n"));
			return ;
		}
		while ($ship->gun)
		{
			$shoot = $this->RollDice();
			array_push($msg, "You throw a dice and obtain $shoot\n");
			if ($shoot >= 4)
			{
				array_push($msg,  "You harm you nemesis ! Keep going !\n");
				$nemesis->ship->shield ? $nemesis->ship->shield-- : $nemesis->ship->lives--;
				if ($shoot == 6)
				{
					$nemesis->ship->lives--;
					array_push($msg, "Critical strike ! Well played captain!\n");
				}
			}
			if ($nemesis->ship->lives <= 0)
				$this->remove_ship($nemesis->ship, $map);
			$ship->gun--;
		}
		echo json_encode(array("map" => $map->space,'messages' => $msg));
	}

	private function hay_target($ship, $map, $nemesis)
	{
		$positions = array();
		$back = $ship->pos;
		$range = 5;//peut etre variable du coup
		while ($range)
		{
			array_push($positions, $ship->pos);
			$this->forward($ship);
			echo $map[$ship->pos[0][$ship->pos[1]]];
			if ($map[$ship->pos[0]][$ship->pos[1]] != '.')
			{
				$ship->pos = $back;
				return (1);
			}
			$range--;
		}
		$ship->pos = $back;
		return (0);
	}

	public function give($ship, $data) //instance de class Spaceship + data web
	{
		$ship->shield = $data['shield'];//HOW INFO FROM HTML IS FORMATED
		$ship->gun = $data['gun'];
		$ship->speed = $data['speed'];
		$repair = $data['repair'];
		while ($repair)
		{
			if ($this->RollDice() == 6 && $ship->lives < $ship->getMax_Lives())
				$ship->lives++;
			$repair--;
		}
	}

	public function move($ship, $data, $map)
	{
		$this->remove_ship($ship, $map);
		if (!$ship->lives)
		{
			echo json_encode(array("message" => "Your ship does not exsit anymore\n"));
			return (0);
		}
		if (!$ship->speed)
		{
			echo json_encode(array("message" => "passe phase suivante\n"));
			if ($ship->lives > 0)
				$this->draw_ship($ship, $map);
			return (0);
		}
		$ship->speed--;
		if ($data['move'] != 'forward')
		{
			if ($ship->last_move < $ship->getMovable())
			{
				echo json_encode(array("message" => "You can't turn so far\n"));
				return (0);
			}
			else
			{
				$this->turn($ship, $data['move']);
				$ship->last_move = 0;
			}
		}
		else
		{
			$this->forward($ship);
			$ship->last_move++;
		}
		if ($this->is_crashed($ship, $map) == TRUE)
		{
			$ship->lives = 0;
			echo json_encode(array("message" => "You crashed your ship\n"));
			return (0);
		}
		else
		{
			$this->draw_ship($ship, $map);
			return (1);
		}
	}

	public function turn($ship, $where)
	{
		if ($where === 'left')
			$ship->aim == 1 ? $ship->aim = 4 : $ship->aim--;
		else
			$ship->aim == 4 ? $ship->aim = 1 : $ship->aim++;
	}

	public function remove_ship($ship, $map)
	{
		$map->space[$ship->pos[0]][$ship->pos[1]] = ".";
		if ($ship->aim % 2 == 0)
		{
			$map->space[$ship->pos[0]][$ship->pos[1] - 1] = ".";//id = LETTRE
			$map->space[$ship->pos[0]][$ship->pos[1] + 1] = ".";
		}
		else
		{
			$map->space[$ship->pos[0] - 1][$ship->pos[1]] = ".";//id = LETTRE
			$map->space[$ship->pos[0] + 1][$ship->pos[1]] = ".";
		}
		return ($map);
	}

	public function draw_ship($ship, $map)
	{//bonus = implementer un draw map pour tous types vaisseaux
		$map->space[$ship->pos[0]][$ship->pos[1]] = $ship->id;
		if ($ship->aim % 2 == 0)
		{
			$map->space[$ship->pos[0]][$ship->pos[1] - 1] = $ship->id;//id = LETTRE
			$map->space[$ship->pos[0]][$ship->pos[1] + 1] = $ship->id;
		}
		else
		{
			$map->space[$ship->pos[0] - 1][$ship->pos[1]] = $ship->id;//id = LETTRE
			$map->space[$ship->pos[0] + 1][$ship->pos[1]] = $ship->id;
		}
		return ($map);
	}

	private function get_area($ship, $map)
	{
		$area = array();
		array_push($area, array($ship->pos[0], $ship->pos[1]));
		if ($ship->aim % 2 == 0)
		{
			array_push($area, array($ship->pos[0], $ship->pos[1] - 1));
			array_push($area, array($ship->pos[0], $ship->pos[1] + 1));
		}
		else
		{
			array_push($area, array($ship->pos[0] - 1, $ship->pos[1]));
			array_push($area, array($ship->pos[0] + 1, $ship->pos[1]));
		}
		return ($area);
	}

	private function is_crashed($ship, $map)
	{
		$area = $this->get_area($ship, $map);
		foreach ($area as $el)
		{
			if ($el[0] > $map->max_X || $el[1] > $map->max_Y
				|| $el[0] < 0 || $el[1] < 0 || $map->space[$el[0]][$el[1]] != '.'
				|| ($el[0] == 10 && $el[1] == 10) || ($el[0] == 20 && $el[1] == 20)
			|| ($el[0] == 45 && $el[1] == 45))
				return TRUE;
		}
		return FALSE;
	}

	public function forward($ship)
	{
		if ($ship->aim == 1)
			($ship->pos[1]--);
		else if ($ship->aim == 2)
			($ship->pos[0]++);
		else if ($ship->aim == 3)
			($ship->pos[1]++);
		else if ($ship->aim == 4)
			($ship->pos[0]--);
	}
}
?>
