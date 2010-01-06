<h1>Profile da Equipe</h1>

<?php
	$idTeam = 6; //Provisório	
	
	$team = new Team;
	$team->getTeam($idTeam);
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
	
	$userTeam = new UserTeam;
	$userTeam->getUserTeam($idUserFacebook,$idTeam);
	
	if( ($userTeam->getIDTeam() != "" && $userTeam->getLocked() == FALSE ) || $team->getIDOwner() == $idUserFacebook)
	{
	?>
		
		<form action='?act=create-game' method='POST'>
			<input type='hidden' id='idTeam' name='idTeam' value=" <? echo $team->getID() ?>" />
			<input type='submit' value="Criar novo jogo" />
		</form>
			
			<form action='?act=invite-friends-team&id=<?= $team->getID()?>' method='POST'>
			<input type='hidden' id='idTeam' name='idTeam' value=" <? echo $team->getID() ?>" />
			<input type='submit' value="Convidar um amigo para este grupo!" />
		</form>
	<?
	}
	else
	
	
?>
