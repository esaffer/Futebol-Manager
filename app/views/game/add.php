<h1>Adicionar Jogo</h1>

<?
	if ($_GET['do'] == 'add') {
		$game = new Game;
		$game->setIDCreator($_POST['idCreator']);		
		$game->setIDTeam($_POST['idTeam']);
		$game->setDescription($_POST['description']);
		$game->setDate($_POST['date']);
		$game->setNumMinPlayers($_POST['numminplayers']);
		$game->setNumMaxPlayers($_POST['nummaxplayers']);
		$game->setCost($_POST['cost']);
		$game->Add();
	}
	else {
		$userteam = new UserTeam;
		$userteam->getUserTeam($idUserFacebook,$_POST['idTeam']); //Como estará dentro do grupo, dever-se-á estar disponível o ID do team...
		$team = new Team;
		$team->getTeam($_POST['idTeam']);
		
		if($userteam->getLocked() == TRUE && $team->getIDOwner != $idUserFacebook)
		{
			echo "Infelizmente voce nao pode criar novos jogos pois esta marcado como bloqueado";
			return;
		}
		else
		{ 
?>

<form action="?act=create-game&do=add" method="POST">
	<label for='date'>Data:</label>
		<input type="text" id='date' name='date' />
	<br />
	<label for='place'>Local:</label>
		<input type="text" id='place' name='place' value="Valor ainda nao setado!!!" />
	<br />
		<label for='numminplayers'>Número mínimo de jogadores:</label>
		<input type="text" id='numminplayers' name='numminplayers' />
	<br />
		<label for='nummaxplayers'>Número máximo de jogadores:</label>
		<input type="text" id='nummaxplayers' name='nummaxplayers' />
	<br />
		<label for='cost'>Custo da partida:</label>
		<input type="text" id='cost' name='cost' />
	<br />
	<label for='description'>Descricao:</label>
		<textarea cols=20 rows=5 id='description' name='description' /></textarea>
	<br />
		<input type="hidden" id='idCreator' name='idCreator' value=' <? echo $idUserFacebook; ?>' />
		<input type="hidden" id='idTeam' name='idTeam' value=' <? echo $_POST['idTeam']; ?>' />
	<input type='submit' value='Salvar' />
</form>
	<? 
		}
	} ?>
