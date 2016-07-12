<?PHP
function ft_split($line)
{
	$tab = explode(" ", $line);
	$tab = array_filter($tab);
	$tab = array_slice($tab, 0);
	sort($tab);
	return ($tab);
}
?>
