<h1>Confirmar ou Recusar requisição</h1>

<?php
	$invite = new Invite;
	$invite->getInvite($_POST['idInvite']);
	
	if($_POST['idTeam'] != $isUserFacebook)
	{
		echo "</ br> Você não tem permissão para executar essa ação";
		return;
	}
	
	if($_POST['status'] == 'false')
	{
		$invite->delete($_POST['idInvite']);
		echo "A requisição foi rejeitada </ br>";
		echo "<a href='?act=home'> Voltar para tela inicial </a> </br>";
		return;
	}
	
	if($_POST['status'] == 'true')
	{
		if($invite->getUserStatus() == True )
		{
			$userteam = new UserTeam;
			$userteam->setIDUser($_POST['idUser']);
			$userteam->setIDTeam($_POST['idTeam']);
			$userteam->setLocked(False);
			$userteam->setDateJoined();
			$userteam->setPoints(0);
			$userteam->Add();
			$invite->delete($_POST['idInvite']);
			echo "O usuario foi adicionado ao grupo! </ br>";
			echo "<a href='?act=home'> Voltar para tela inicial </a> </br>";
			return;
		}
		else
		{
			$invite->setStatus(1);
			$invite->Edit($_POST['idInvite']);
			echo "</ br> O usuário entrará no grupo assim que ele aceitar o convite!";
			return;
		}
	}
	

?>
<br><br><br>
