#!/usr/bin/php
<?PHP

function	get_img_url($file)
{
	$tab = array();
	preg_match_all("/\<(.*?)IMG(.*?)SRC=[\'\"](.*?)[\'\"]/i", $file, $tab);
	return ($tab[3]);
}

function	get_photo($name)
{
	$tab = array();
	preg_match("/(.*?)(png|jpg|gif|bmp|jpeg)/", $name, $tab);
	return ($tab[0]);
}

function	get_name($name)
{
	$tab = array();
	preg_match("/[^\/]*\/?$/", $name, $tab);
	return ($tab[0]);
}

function	get_file($url)
{
	$c = curl_init($url);
	curl_setopt($c, CURLOPT_RETURNTRANSFER, TRUE);
	$file = curl_exec($c);
	curl_close($c);
	return ($file);
}

function	binary_image($url)
{
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
	$raw = curl_exec($ch);
	curl_close ($ch);
	return ($raw);
}

if ($argc != 2)
	exit ("One and only one argument please\n");
$arg = $argv[1];
$dir = get_name($arg);
if (file_exists($dir))
	exit ("The dir $dir already exists, please remove it\n");
mkdir ($dir);
chdir ($dir);
$file = get_file($arg);
$tab = get_img_url($file);
foreach($tab as $el)
{
	$name = get_name(get_photo($el));
	if ($name && !file_exists($name))
	{
		$img = fopen(get_name(get_photo($el)), 'w');
		fwrite($img, binary_image(get_photo($el)));
		fclose($img);
	}
}
?>
