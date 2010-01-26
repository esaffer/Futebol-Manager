<?php
	$invite = new Invite;
	$invite->getInvite($_POST['idInvite']);
	if($_POST['status'] == 'true')
	{
		if($invite->getStatus() == true)
		{
			$userteam = new UserTeam;
			$userteam->setIDUser($idUserFacebook);
			$userteam->setIDTeam($_POST['idTeam']);
			$userteam->setLocked(False);
			$userteam->setDateJoined();
			$userteam->setPoints(0);
			$userteam->Add();
			
			$team = new Team;
			$team->getTeam($_POST['idTeam']);
			
			echo "Seja bem vindo(a) ao grupo '$team->getName()'! </ br>";
			echo "<a href='team-view-profile&view=".$team->getID()".'> Ir ao perfil do grupo </a> </br>"; 
			$invite->delete($_POST['idInvite']);
		}
		else
		{
			echo "Você aceitou o convite! </ br>";
			echo "Aguarde a aprovação do Owner do grupo </ br>";
			$invite->setUserStatus(1);
			$invite->Edit($_POST['idInvite']);
			echo "<a href='?act=home'> Voltar para tela inicial </a> </br>";
		}
	}
	else{
		$invite->delete($_POST['idInvite']);
		echo "<\ br>Seu convite foi deletado com sucesso!";
		echo "<\ br><a href='?act=home'> Voltar para tela inicial </a> </br>";
	}		

?>
<br><br><br>
