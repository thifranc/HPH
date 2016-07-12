<?PHP
if ($_POST['submit'] == "OK" && $_POST['login'] && $_POST['passwd'])
{
    if (file_exists("private/passwd"))
    {
        $tab = unserialize(file_get_contents("private/passwd"));
        foreach ($tab as $elem)
            if ($elem['login'] == $_POST['login'])
            {
                header("Location: create.php?create=full");
                return (-1);
            }
    }
    $new_account['login'] = $_POST['login'];
    $new_account['passwd'] = hash("whirlpool", $_POST['passwd']);
    $new_account['is_admin'] = 0;
    $tab[] = $new_account;
    $tmp = serialize($tab);
    file_put_contents("private/passwd", $tmp);
    header("Location: index.php");
}
if ($_GET['create'] == "full")
    echo "Sorry this user is already registered<br/>";
?>
<html><body>
        <head>
            <title>Creation du compte</title>
            <meta charset="UTF-8" />
            <link rel="stylesheet" href="shop.css" type="text/css" />
        </head>
        <div class="container"><form action="create.php" method="POST">
                Identifiant: <input type="text" name="login" value="" />
                <br />
                Mot de passe: <input type="password" name="passwd" value="" />
                <br />
                <input type="submit" name="submit" value="OK" />
            </form>
            <a href="index.php">RETOUR A L'ACCUEIL</a>
        </div>
</body></html>
