<?php
function buy_form($action)
{
	echo '<form action="'.$action.'" method="POST">
		<input type="hidden" name="form" value="buy_cart" />
		<input type="submit" name="submit" value="Commander" />
		</form>';
}
?>
