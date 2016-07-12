#!/usr/bin/php
<?PHP
date_default_timezone_set("Europe/Paris");
$file = fopen("/var/run/utmpx", "r");
$final = array();
while (($data = fread($file, 628)))
{
	$tab = unpack("a256user/a4id/a32line/ipid/itype/I2time/a256host/i16pad", $data);
	if ($tab['type'] == 7)
		array_push ($final, $tab['user']." ".$tab['line']."  ".date("M d H:i", $tab['time1']));
}
	sort($final);
	foreach($final as $el)
		echo "$el\n";
?>
