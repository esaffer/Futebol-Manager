<h1>Perfil do Jogo</h1>

<?php
	$idgame = $_GET['view'];
	
	$game = new Game;
	$game->getGame($idgame);
	
	
	
	if($idgame == "" || $game->getID() == NULL)
	{
		echo "O jogo selecionado não existe!";
		return;
	}	
	
	$team = new Team;
	$team->getTeam($game->getIDTeam());
	
	if($_GET['do'] == 'accept')
	{
		$userGame = new UserGame;
		$var = $userGame->getUserGame($idgame, $idUserFacebook,$team->getID());
		if($var == False) //Jogador não tinha marcado nada ainda.
		{
			$userGame->setIDTeam($team->getID());
			$userGame->setIDUser($idUserFacebook);
			$userGame->setIDGame($idgame);
			$userGame->setStatus(1); // Vai ir...
			$userGame->Add();
		}
		else {
			$userGame->setStatus(1); // Vai ir...
			$userGame->Edit("idUser = $idUserFacebook AND idTeam = ". $team->getID() ." AND idGame = $idgame");				
		}	
	}
	
	if($_GET['do'] == 'reject')
	{
		$userGame = new UserGame;
		$var = $userGame->getUserGame($idgame, $idUserFacebook,$team->getID());
		if($var == False) //Jogador não tinha marcado nada ainda.
		{
			$userGame->setIDTeam($team->getID());
			$userGame->setIDUser($idUserFacebook);
			$userGame->setIDGame($idgame);
			$userGame->setStatus(-1); // Não vai ir
			$userGame->Add();
		}
		else {
			$userGame->setStatus(-1); // Não vai ir
			$userGame->Edit("idUser = $idUserFacebook AND idTeam = ". $team->getID() ." AND idGame = $idgame");			
		}		
	}
	
	

	
	$user = new User;
	$user->getUser($game->getIDCreator());
	
	echo "<br>Nome do Grupo: ";
	echo "<a href='?act=team-view-profile&view='".$team->getID()." '>".$team->getName()."</a>";	
	
	echo "<br>Nome do Criador do jogo: ";
	echo "<a href='?act=user-view-profile&view='".$user->getID()."'>".$user->getNick()."</a>";
	
	echo "<br>Número mínimo de jogadores: ";
	echo $game->getNumMinPlayers();
	
	echo "<br>Número máximo de jogadores: ";
	echo $game->getNumMaxPlayers();
	
	echo "<br>Custo do jogo: ";
	echo $game->getCost();
	
	echo "<br>Hora do jogo: ";
	echo date("Y-m-d H:i:s",$game->getDate());
	
	echo "<br>Descrição: ";
	echo $game->getDescription();
	
	$userGame = new UserGame;
	echo "</br></br>Jogadores que confirmaram presença: ";
	$matriz = $userGame->getListUserTeam($idgame,1);
	if($matriz == False)
	{
		echo "</ br> Nenhum jogador confirmou presença!";
	}
	else
	{
		$naovai = new User;
		foreach($matriz as $lista)
		{
			$naovai->getUser($lista->idUser);
			echo "</ br> <a href='?act=user-view-profile&view='".$naovai->getID()."'>".$naovai->getNick()."</a>";
		}		
	}
	
	echo "</br></br></br>Jogadores que não irão: ";
	$matriz = $userGame->getListUserTeam($idgame,-1);
	if($matriz == False)
	{
		echo "</ br> Nenhum jogador negou que irá!";
	}
	else
	{
		$vai = new User;
		foreach($matriz as $lista)
		{
			$vai->getUser($lista->idUser);
			echo "</ br> <a href='?act=user-view-profile&view='".$vai->getID()."'>".$vai->getNick()."</a>";
		}		
	}	
	
	//Executa ações restrita ao Owner do time ou ao Creator. 
	if($game->getIDCreator() == $idUserFacebook || $team->getIDOwner() == $idUserFacebook )
	{
		?>		
			<form action='?act=game-edit&id=<?= $game->getID()?>' method='POST'>
				<input type='submit' value="Editar jogo" />
			</form>
		<?
	}	
	
	//Confirmar presença ou não...
	$userTeam = new UserTeam;
	$pertence = $userTeam->getUserTeam($idUserFacebook,$team->getID());
	
	if($pertence != False || $team->getIDOwner() == $idUserFacebook) //Faz parte do time
	{
		$userGame = new UserGame;
		$marcou = $userGame->getUserGame($idgame,$idUserFacebook,$team->getID());
		if($marcou != False) // Jah disse se vai ou nao...
		{
			if($userGame->getStatus() == 1) //Disse que vai
			{
			?>
			<form action='?act=game-view-profile&view=<?= $game->getID()?>&do=reject' method='POST'>
				<input type='submit' value="Não irei ao jogo" />
			</form>  
			<?
			}
			else //Disse que não vai...
			{
			?>
			<form action='?act=game-view-profile&view=<?= $game->getID() ?>&do=accept' method='POST'>
				<input type='submit' value="Irei ao jogo" />
			</form>  
			<?
			}
		
		}	
		else //Não disse nada, mostra as duas opções
		{
		?>
		<form action='?act=game-view-profile&view=<?= $game->getID()?>&do=reject' method='POST'>
			<input type='submit' value="Não irei ao jogo" />
		</form>  
		
		<form action='?act=game-view-profile&view=<?= $game->getID() ?>&do=accept' method='POST'>
			<input type='submit' value="Irei ao jogo" />
		</form>  		
		<?
		}
	}
?>
