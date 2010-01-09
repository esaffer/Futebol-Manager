<h1>Profile da Equipe</h1>

<?php

	$idTeam = $_GET['view'];
	
	if($idTeam == "")
	{
		echo "Nenhum grupo selecionado!";
		return;
	}
		
	$team = new Team;
	$team->getTeam($idTeam);
	
	$userTeam = new UserTeam;
	$linha = $userTeam->getUserTeam($idUserFacebook,$idTeam);
	
	if($team->getPrivative() == TRUE && $team->getIDOwner() != $idUserFacebook && $linha == False)
	{
		echo "Desculpe, mas você não tem permissão de ver o perfil deste grupo";
	}
	else
	{
?>

		<?= $team->getImage($idTeam); ?>
		<br />
		Nome: <?= $team->getName() ?>
		<br/>
		Data de cadastro: <?= $team->getDateCreated() ?>
		<br />
		Nome do criador do grupo: <?= $team->getTeamOwnerName() ?>
		<br />
		Tipo de grupo: <?= ($team->getPrivative() == True) ? 'Privado' : 'Publico' ?>
		<br />
		Descrição: <?= $team->getDescription() ?>
		<br />
		Regras: <?= $team->getRules() ?>
		<br />
		Jogos Marcados: (Fazer!)
		<br />	
		<?php

	//Executa ações restrita a membros. Implementar tudo logo após	
		if( ($userTeam->getIDTeam() != "" && $userTeam->getLocked() == FALSE ) || $team->getIDOwner() == $idUserFacebook)
		{
		?>
		
			<form action='?act=create-game' method='POST'>
				<input type='hidden' id='idTeam' name='idTeam' value=" <?= $team->getID() ?>" />
				<input type='submit' value="Criar novo jogo" />
			</form>
			
				<form action='?act=invite-friends-team&id=<?= $team->getID()?>' method='POST'>
				<input type='hidden' id='idTeam' name='idTeam' value=" <?= $team->getID() ?>" />
				<input type='submit' value="Convidar um amigo para este grupo!" />
			</form>
		<?
		}	
	}
?>
