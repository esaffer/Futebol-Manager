<h1>Adicionar Jogo</h1>

<?php

	if($_POST['idTeam'] == "")
	{
		echo "<br> Impossível criar novo jogo";
		return;
	}
	
	if($_POST['date'] <= date("Y-m-d H:i:s",time()) && $_GET['do'] == 'add')
	{
		echo "<br><br> You don't have a time machine, so, you can't do a game in the past!";
		$team_aux = new Team;
		$team_aux->getTeam($_POST['idTeam']);
		echo "<br><br><br><a href='?act=team-view-profile&view=".$team_aux->getID()."'> Ver perfil do <b>".$team_aux->getName()."</b> </a>";	
		return;
	}

	if ($_GET['do'] == 'add') {
		$game = new Game;
		$game->setIDCreator($_POST['idCreator']);		
		$game->setIDTeam($_POST['idTeam']);
		$game->setDescription($_POST['description']);
		$game->setDateNotTimestamp($_POST['date']); // Deve ser do formato Y-m-d H:i:s
		$game->setNumMinPlayers($_POST['numminplayers']);
		$game->setNumMaxPlayers($_POST['nummaxplayers']);
		$game->setCost($_POST['cost']);
		$game->Add();
		$lista_ids = geraWarning($_POST['idTeam'],$idUserFacebook);
		
		$team = new Team;
		$team->getTeam($_POST['idTeam']);
		
		$mensagem = "Um novo jogo foi criado no grupo <b>".$team->getName()."</b>";
		$notification = $facebook->api_client->notifications_send($lista_ids, $mensagem, 'app_to_user');
		
		echo "<br><br> O jogo foi criado com sucesso!";		
		echo "<br><br><br><a href='?act=team-view-profile&view=".$team->getID()."'> Ver perfil do grupo <b>".$team->getName()."</b> </a>";
	}
	else {
		$userteam = new UserTeam;
		$userteam->getUserTeam($idUserFacebook,$_POST['idTeam']);
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
		<!--			<label for='place'>Local:</label>
					<input type="text" id='place' name='place' value="Valor ainda nao setado!!!" />
				<br /> -->
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
	
<?php

function geraWarning($idTeam,$idUser)
{
	$team = new Team;
	$team->getTeam($idTeam);
	
	$alerta = new Warning;
	
	$userTeam = new UserTeam;
	$lista_users = $userTeam->getListTeam($idTeam);
	
	$user = new User;
	$user->getUser($idUser);
	
	$mensagem = "O usuário  <b>".$user->getNick()."</b> do grupo <b>" . $team->getName() . "</b> criou um novo jogo!</ br>";
	
	$lista_ids = "";
	
	if($lista_users != False)
	{
		foreach($lista_users as $lista)
		{
			$alerta->setIDDestino($lista->idUser);
			$alerta->setDate();
			$alerta->setText($mensagem);
			$alerta->Add();
			
			if($lista_ids == "")
			{			
				$lista_ids = $lista->idUser;
			}
			else
			{
				$lista_ids = $lista_ids.",".$lista->idUser;
			}
		}
	}
	
	$alerta->setIDDestino($team->getIDOwner());	
	$alerta->setDate();
	$alerta->setText($mensagem);
	$alerta->Add();
	
	$lista_ids = $lista_ids.",".$team->getIDOwner();
	return $lista_ids;
}
?>
