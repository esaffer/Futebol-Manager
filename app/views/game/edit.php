<h1>Editar Jogo</h1>

<?php
	$idgame = $_GET['id'];
	
	$idgame = 13; //Provisorio!!!!

	if($idgame == "")
	{
		echo "Nenhum jogo selecionado";
		return;
	}	
	
	$game = new Game;
	$game->getGame($idgame);
	
	$team = new Team;
	$team->getTeam($game->getIDTeam());

	if($game->getIDCreator() != $idUserFacebook && $team->getIDOwner() != $idUserFacebook)
	{
		echo "Desculpe, você não tem permissão para editar este jogo!";
		return;	
	}	
	
	if ($_GET['do'] == 'edit') {
		$game = new Game;
		$game->setIDCreator($_POST['idCreator']);		
		$game->setIDTeam($_POST['idTeam']);
		$game->setDescription($_POST['description']);
		$game->setDate($_POST['date']);
		$game->setNumMinPlayers($_POST['numminplayers']);
		$game->setNumMaxPlayers($_POST['nummaxplayers']);
		$game->setCost($_POST['cost']);
		$game->Edit($idgame);
	}
	else {
		$userteam = new UserTeam;
		$userteam->getUserTeam($idUserFacebook,$team->getID());
		
		$team = new Team;
		$team->getTeam($game->getIDTeam());
		
		if($userteam->getLocked() == TRUE && $team->getIDOwner != $idUserFacebook)
		{
			echo "Infelizmente voce nao pode criar novos jogos pois esta marcado como bloqueado";
			return;
		}
		else
		{ 
?>

<form action="?act=game-edit&do=edit" method="POST">
		<label for='date'>Data:</label>
		<input type="text" id='date' name='date' value='<?= $game->getDate() ?>' />
	<br />
		<label for='place'>Local:</label>
		<input type="text" id='place' name='place' value="Valor ainda nao setado!!!" />
	<br />
		<label for='numminplayers'>Número mínimo de jogadores:</label>
		<input type="text" id='numminplayers' name='numminplayers' value='<?= $game->getNumMinPlayers() ?>' />
	<br />
		<label for='nummaxplayers'>Número máximo de jogadores:</label>
		<input type="text" id='nummaxplayers' name='nummaxplayers' value='<?= $game->getNumMaxPlayers() ?>' />
	<br />
		<label for='cost'>Custo da partida:</label>
		<input type="text" id='cost' name='cost' value='<?= $game->getCost() ?>' />
	<br />
		<label for='description'>Descricao:</label>
		<textarea cols=20 rows=5 id='description' name='description'><?=$game->getDescription() ?></textarea>
	<br />
		<input type="hidden" id='idCreator' name='idCreator' value='<?= $game->getIDCreator() ?>' />
		<input type="hidden" id='idTeam' name='idTeam' value=' <?= $team->getID() ?>' />
	<input type='submit' value='Salvar' />
</form>
	<? 
		}
	} ?>
