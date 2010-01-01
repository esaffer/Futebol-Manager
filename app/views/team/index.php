<?
	//Retorna o Time baseado no ID do Owner, corrigir para mostrar TODOS!
	$grupo = new Team;
	$grupo->getTeamOwner($idUserFacebook);
	echo "<br> Nome == " . 	$grupo->getNome();
	echo "<br> Local == " .	$grupo->getLocal();
?>
