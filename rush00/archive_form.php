<?php
function archive_form($action)
{
	echo '<form action="'.$action.'" method="POST">
		<input type="hidden" name="form" value="archive_cart" />
		<input type="submit" name="submit" value="Archiver le Panier" />
		</form>';
}
?>
