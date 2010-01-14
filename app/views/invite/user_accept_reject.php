<?php
	$invite = new Invite;
	$invite->getInvite($_POST['idInvite']);
	if($_POST['status'] == 'true'){
		if($invite->getStatus() == true){
			echo "adicionando user ao grupo..";
			/*$team = new UserTeam;
			$team->setIDUser($_POST['id']);
			$team->setIDTeam($_POST['idTeam']);
			$team->setLocked(false);
			$team->Add();*/
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
