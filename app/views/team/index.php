<?
	//Retorna o Time baseado no ID do Owner, corrigir para mostrar TODOS!
	$grupo = new Team;
	$grupo->getGrupoOwner($idUserFacebook);
	echo "<br> Nome == " . 	$grupo->getNome();
	echo "<br> Local == " .	$grupo->getLocal();
?>
