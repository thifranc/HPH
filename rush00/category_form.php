<?
if (file_exists("private/item"))
{
	$tab = unserialize(file_get_contents("private/item"));
	if (is_array($tab) && is_array($tab["cat"]))
	{
		foreach ($tab["cat"] as $id => $cat)
		{
			echo "<form action='index.php' method='post'>";
			echo "<input type='hidden' name='category' value='".$id."' />
				<input type='submit' value='".$cat."' /></form>";
		}

	}
}
?>
