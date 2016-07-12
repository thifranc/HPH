#!/usr/bin/php
<?PHP

function	get_all_pos($str, $search)
{
	$offset = 0;
	$out = array();
	while (($pos = strpos($str, $search, $offset)) != FALSE)
	{
		array_push($out, $pos);
		$offset += $pos + strlen($search);
	}
	return ($out);
}

function	upper2($str)
{
	$str[3] = mb_strtoupper($str[3], "UTF-8");
	return "<".$str[1].$str[2].$str[3].$str[5].">";
}

function	upper($str)
{
	return mb_strtoupper($str[0], "UTF-8");
}

function	balise($str)
{
	return preg_replace_callback("/\>(.*?)\</", "upper", $str[0]);
}
	if ($argc != 2)
		exit ();
	if (!is_readable($argv[1]))
		exit ("Wrong file");
	if (!($file = file_get_contents($argv[1])))
		exit ("Wrong file");
	$new_line = preg_replace_callback("/\<a(.*?)\<\/a\>/", "balise", $file);
	$final_line = preg_replace_callback("/\<(.*?)(title\=[\'\"])((.*?)[\'\"])(.*?)\>/si", "upper2", $new_line);
	echo $final_line;
?>
