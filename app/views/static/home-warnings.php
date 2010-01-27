<?
// --- Avisos -------------------------------------------------------------
	$avisos = new Warning;
	$avisos = $avisos->getListUser($idUserFacebook);

	echo "<div id='warnings'>";
	echo "	<div id='warning-title'>Avisos</div>";
	echo "	<div id='warning-content'>";

	if ($avisos == False)
	{
		echo "	Nenhum aviso encontrado!";
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
	echo "</div></div>";
?>
