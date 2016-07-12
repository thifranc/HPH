<?php
include "home_form.php";
function admin_left()
{
	echo	"<body>
				<div class='container'>
					<div class='category_list'>";
home_form("index.php");
	echo					"<form action='privilege.php' method='post'>
							<input type='submit' name='Modification Utilisateurs' value='Modification Utilisateurs' />
						</form>
						<form action='item.php' method='post'>
							<input type='submit' name='Modification Articles' value='Modification Articles' />
						</form>
					</div>";
}

function admin_right()
{
	echo				"<div class='login'>
							<form action='logout.php' method='POST'>
								<input type='submit' name='submit' value='D&eacute;connexion' />
							</form>
						</div>
					</div>
				</body>
			</html>";
}

?>
