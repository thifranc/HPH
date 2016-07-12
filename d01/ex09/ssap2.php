#!/usr/bin/php
<?PHP

	function is_alpha($str)
	{
		$p = 0;
		while ($str[$p])
		{
			if (($str[$p] < '0') || ($str[$p] > '9' && $str[$p] < 'A') || ($str[$p] > 'Z' && $str[$p] < 'a') || ($str[$p] > 'z'))
				return FALSE;
			$p++;
		}
		return TRUE;
	}
    $i = 1;
    if ($argc == 1)
        exit();
    while ($i < $argc)
    {
		$argv[$i] = trim($argv[$i]);
	    while (strpos($argv[$i], "  "))
    	    $argv[$i] = str_replace("  ", " ", $argv[$i]);
		if ($argv[$i])
        	$tab[$i - 1] = explode(" ", $argv[$i]);
        $i++;
    }
    $i = 2;
    $max_tab = array_merge($tab[0], $tab[1]);
    while ($tab[$i])
    {
        $max_tab = array_merge($max_tab, $tab[$i]);
        $i++;
    }
	$num_tab = array();
	$alpha_tab = array();
	$oth_tab = array();
	foreach ($max_tab as $cur)
	{
		if (is_numeric($cur))
			array_push($num_tab, $cur);
		else if (is_alpha($cur))
			array_push($alpha_tab, $cur);
		else
			array_push($oth_tab, $cur);
	}
	sort($alpha_tab, SORT_FLAG_CASE|SORT_NATURAL);
	sort($num_tab, SORT_STRING);
	sort($oth_tab, SORT_STRING);
	foreach($alpha_tab as $el)
		echo $el."\n";
	foreach($num_tab as $el)
		echo $el."\n";
	foreach($oth_tab as $el)
		echo $el."\n";
?>
