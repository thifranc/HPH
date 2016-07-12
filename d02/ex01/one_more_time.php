#!/usr/bin/php
<?PHP

function checkmonth($word)
{
	$word[0] = strtolower($word[0]);
	$month = array(
		"janvier" => 1,
		"février" => 2,
		"mars" => 3,
		"avril" => 4,
		"mai" => 5,
		"juin" => 6,
		"juillet" => 7,
		"août" => 8,
		"septembre" => 9,
		"octobre" => 10,
		"novembre" => 11,
		"décembre" => 12,);
	if ($month[$word])
		return ($month[$word]);
	else
		return (0);
}

function is_bissextile($year)
{
	if ($year % 4 != 0)
		return FALSE;
	else if ($year % 100 != 0)
		return TRUE;
	else if ($year % 400 != 0)
		return FALSE;
	else
		return TRUE;
	return FALSE;
}

function nb_jour($word, $year)
{
	$word[0] = strtolower($word[0]);
	$month = array(
		"janvier" => 31,
		"février" => 28,
		"mars" => 31,
		"avril" => 30,
		"mai" => 31,
		"juin" => 30,
		"juillet" => 31,
		"août" => 31,
		"septembre" => 30,
		"octobre" => 31,
		"novembre" => 30,
		"décembre" => 31,);
	$out = $month[$word];
	if ($word == "février" && is_bissextile($year))
		$out++;
	return ($out);
}

function checkday($word)
{
	$word[0] = strtolower($word[0]);
	$day = array(
		"lundi" => 1,
		"mardi" => 1,
		"mercredi" => 1,
		"jeudi" => 1,
		"vendredi" => 1,
		"samedi" => 1,
		"dimanche" => 1,);
	if ($day[$word])
		return (1);
	else
		return (0);
}

function is_4nb($word)
{
	return (preg_match("/^[0-9]{4}$/", $word));
}

function is_2nb($word)
{
	return (preg_match("/^[0-9]{2}$/", $word));
}

date_default_timezone_set("Europe/Paris");
if ($argc != 2)
	exit ();
$data = explode(" ", $argv[1]);
$hour = explode(":", $data[4]);
if (checkday($data[0]) == 0 || ($month = checkmonth($data[2])) == 0 || is_4nb($data[3] == 0) || !is_numeric($data[1]) || $data[1] > nb_jour($data[2], $data[3]))
	exit ("Wrong Format\n");
if (!is_2nb($hour[0]) || !is_2nb($hour[1]) || !is_2nb($hour[2]) || $hour[1] > 59 || $hour[2] > 59 || $hour[0] > 23)
	exit ("Wrong Format\n");
$final = $data[3] . "-" . $month . "-" . $data[1] . " " . $data[4];
$diff = strtotime($final);
echo $diff."\n";
?>
