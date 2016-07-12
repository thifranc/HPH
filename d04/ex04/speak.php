<?PHP
session_start();
date_default_timezone_set("Europe/Paris");
if ($_POST['submit'] == "OK" && $_SESSION['loggued_on_user'] && $_POST['msg'])
{
    if (!file_exists("../private"))
        mkdir("../private");
    if (file_exists("../private/chat"))
        $tab = unserialize(file_get_contents("../private/chat"));
    $new_msg['login'] = $_SESSION['loggued_on_user'];
    $new_msg['msg'] = $_POST['msg'];
	$new_msg['time'] = time();
    $tab[] = $new_msg;
    $tmp = serialize($tab);
 	file_put_contents("../private/chat", $tmp);
}
echo
<<<html
<form method="post" action="speak.php">
<input type="text" name="msg" style="width:90%">
<input type="submit" name="submit" value="OK">
</form>
html;
?>
