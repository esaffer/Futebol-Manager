<?php
	$invite = new Invite;
	$invite->getInvite($_POST['idInvite']);
	if($_POST['status'] == 'true'){
		if($invite->getStatus() == true){
			$userteam = new UserTeam;
			$userteam->setIDUser($idUserFacebook);
			$userteam->setIDTeam($_POST['idTeam']);
			$userteam->setLocked(False);
			$userteam->setDateJoined(NULL);
			$userteam->setPoints(0);
			$userteam->Add();
			echo "Você foi adicionado com sucesso já que o convite foi efetuado pelo owner!";
			$invite->delete($_POST['idInvite']);
		}
		else{
			echo "Você aceitou o convite! </ br>";
			echo "Aguarde a aprovação do Owner do grupo </ br>";
			$invite->setUserStatus(1);
			$invite->Edit($_POST['idInvite']);
			echo "<a href='?act=home'> Voltar para tela inicial </a> </br>";
		}
	}
	else{
		$invite->delete($_POST['idInvite']);
		echo "<a href='?act=home'> Voltar para tela inicial </a> </br>";
	}		

?>
<br><br><br>
