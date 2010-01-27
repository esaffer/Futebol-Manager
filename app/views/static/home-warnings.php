<?
// --- Avisos -------------------------------------------------------------
	$avisos = new Warning;
	$avisos = $avisos->getListUser($idUserFacebook);

	echo "<div id='warning'>";
	echo "<span class='warning-title'>Avisos</span>";
	echo "<span class='warning-content'>";

	if ($avisos == False)
	{
		echo "Nenhum aviso encontrado!";
	}
	else
	{
		echo "<ul>";
		foreach ($avisos as $aviso)
		{
			echo "<li>" . $aviso->text . "</li>";
		}
		echo "</ul>";
	}
	echo "</span></div>";
?>
