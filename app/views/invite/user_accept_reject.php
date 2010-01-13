<?php
	$invite = new Invite;
	$invite->getInvite($_POST['id']);
	if( $_POST['status'] == 'true'){
		if($invite->getStatus() == true){
			echo "adicionando user ao grupo..";
			/*$team = new UserTeam;
			$team->setIDUser($_POST['id']);
			$team->setIDTeam($_POST['idTeam']);
			$team->setLocked(false);
			$team->Add();*/
		}
		else{
			echo "convite aceito!";
			$invite->setUserStatus('1');
			$invite->Edit($_POST['id']);
		}
	}
	else{
		echo "Deleta o convite.. nao implementado";//$invite->Delete($_POST['id']);
	}		

?>
<br><br><br>