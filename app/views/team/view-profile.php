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
	<form action="?act=create-game" method="POST">
		<input type="hidden" id='idTeam' name='idTeam' value="<?= $team->getID() ?>" />
		<input type='submit' value="Criar novo jogo" />
	</form>

