#!/usr/bin/php
<?PHP
	if ($argc != 2)
		exit ();
	if ($argv[1] == "mais pourquoi cette demo ?")
		echo "Tout simplement pour qu'en feuilletant le sujet\non ne s'apercoive pas de la nature de l'exo\n";
	if ($argv[1] == "mais pourquoi cette chanson ?")
		echo "Parce que Kwame a des enfants\n";
	if ($argv[1] ==  "vraiment ?")
	{
		if (file_exists(".hidden"))
			echo "Oui il a vraiment des enfants\n";
		else
		{
			$file = fopen(".hidden", "x+");
			echo "Nan c'est parce que c'est le premier avril\n";
		}
	}
?>
