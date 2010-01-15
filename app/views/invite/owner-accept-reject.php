<h1>Confirmar ou Recusar requisição</h1>

<?php
	$invite = new Invite;
	$invite->getInvite($_POST['idInvite']);
	
	if($_POST['status'] == 'true'){
		$userteam = new UserTeam;
		$userteam->setIDUser($_POST['idUser']);
		$userteam->setIDTeam($_POST['idTeam']);
		$userteam->setLocked(False);
		$userteam->setDateJoined(NULL);
		$userteam->setPoints(0);
		$userteam->Add();
		$invite->delete($_POST['idInvite']);
		echo "O usuario foi adicionado ao grupo!";
	}
	else{
		$invite->delete($_POST['idInvite']);
		echo "A requisição foi rejeitada <br>";
		echo "<a href='?act=home'> Voltar para tela inicial </a> </br>";
	}		

?>
<br><br><br>
