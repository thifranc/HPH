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
	public $armada = array();

	function __construct($kwargs)
	{
		$this->name = $kwargs['name'];
		$this->armada = $kwargs['armada'];
		$this->ship = $kwargs['ship'];

		//this->ship should not be fixed as no one is activated yet
	}


	public function gun($ship, $map, $nemesis)     //prend armada ennemie normalement
	{
		$msg = array();
		if (!$ship->gun)
		{
			echo json_encode(array("message" => "You don't hany any ammo left, reload comrade !\n"));
			return ;
		}
		if ($rank = ($this->hay_target($ship, $map->space, $nemesis) === FALSE))   //recup target id normaly
		{
			echo json_encode(array("message" => "You can't reach anything, you lose your PP stupidly\n"));
			return ;
		}
		while ($ship->gun)
		{
			$shoot = $this->RollDice();
			array_push($msg, "You throw a dice and obtain $shoot, try to kill ".$nemesis->armada[$rank]->id."\n");
			if ($shoot >= 4)
			{
				array_push($msg,  "You harm you nemesis ! Keep going !\n");
				$nemesis->armada[$rank]->shield ? $nemesis->armada[$rank]->shield-- : $nemesis->armada[$rank]->lives--;
				if ($shoot == 6)
				{
					$nemesis->armada[$rank]->lives--;
					array_push($msg, "Critical strike ! Well played captain!\n");
				}
			}
			if ($nemesis->armada[$rank]->lives <= 0)
				$this->remove_ship($nemesis->armada[$rank], $map);
			$ship->gun--;
		}
		echo json_encode(array("map" => $map->space,'messages' => $msg));
	}

	private function hay_target($ship, $map, $nemesis)
	{
		$positions = array();
		$back = $ship->pos;
		$range = $ship->getRange();           //peut etre variable du coup
		while ($range)
		{
			$this->forward($ship);
			array_push($positions, $ship->pos);
			if ($map[$ship->pos[0]][$ship->pos[1]] != '.' && $map[$ship->pos[0]][$ship->pos[1]] != $ship->id[0])
			{
				$rank = 0;
				while ($nemesis->armada[$rank])
				{
					if ($map[$ship->pos[0]][$ship->pos[1]] == $nemesis->armada[$rank]->id[0]) //2 chars ??
					{

						$ship->pos = $back;
						return ($rank);
					}
					$rank++;
				}
			}
			$range--;
		}
		$ship->pos = $back;
		return (FALSE);
	}

	public function give($ship, $data)
	{
		$msg = array();
		$ship->shield = $data['shield'];
		$ship->gun = $data['gun'];
		$ship->speed = $data['speed'];
		$repair = $data['repair'];
		while ($repair)
		{
			if ($this->RollDice() == 6 && $ship->lives < $ship->getMax_Lives())
			{
				$ship->lives++;
				array_push($msg, "Your engineer know how to handle it ! You get back one live point !");
			}
			$repair--;
		}
		array_push($msg, "You ship has now:\nshield:".$shipt->shield."\ngun:".$ship->shield."\nlvies:".$ship->lives."\nspeed:".$ship->speed);
		echo json_encode(array("messages" => $msg));
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
				$this->draw_ship($ship, $map);
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

	private function turn($ship, $where)
	{
		if ($where === 'left')
			$ship->aim == 1 ? $ship->aim = 4 : $ship->aim--;
		else
			$ship->aim == 4 ? $ship->aim = 1 : $ship->aim++;
	}

	private function remove_ship($ship, $map)
	{
		$area = $this->get_area($ship, $map);
		foreach ($area as $el)
		{
			$map->space[$el[0]][$el[1]] = ".";
		}
		return ($map);
	}

	public function draw_ship($ship, $map)
	{
		$area = $this->get_area($ship, $map);
		foreach ($area as $el)
		{
			$map->space[$el[0]][$el[1]] = $ship->id;
		}
		return ($map);
	}

	private function get_area($ship, $map)
	{
		$area = array();
		$X_gap = $ship->getGap_x();
		$Y_gap = $ship->getGap_y();
		if ($ship->aim % 2 == 0)
		{
			$X_gap = $ship->getGap_y();
			$Y_gap = $ship->getGap_x();
		}
		$cur_x = $ship->pos[0] - $X_gap; //position coin haut gauche
		$cur_y = $ship->pos[1] - $Y_gap;
		while (($cur_y != $ship->pos[1] + $Y_gap + 1))
		{
			array_push($area, array($cur_x, $cur_y));
			if ($cur_x == $ship->pos[0] + $X_gap)
			{
				$cur_y++;
				$cur_x = $ship->pos[0] - $X_gap;
			}
			else
				$cur_x++;
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
			//pour faire + propre, faire un in_array de tous les $el avec les obstacles
		}
		return FALSE;
	}

	private function forward($ship)
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
