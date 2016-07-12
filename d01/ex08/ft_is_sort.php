<?PHP
	function ft_is_sort($tab)
	{
		$old = $tab;
		sort($tab);
		if ($old == $tab)
			return (TRUE);
		rsort($tab);
		if ($old == $tab)
			return (TRUE);
		else
			return (FALSE);
	}
?>
