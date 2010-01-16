<h1>Perfil do Jogo</h1>

<?php
	$idgame = $_GET['view'];
	
	if($idgame == "")
	{
		echo "Nenhum jogo selecionado";
		return;
	}	
	
	$game = new Game;
	$game->getGame($idgame);
	
	$team = new Team;
	$team->getTeam($game->getIDTeam());
	
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
		$user = new User;
		foreach($matriz as $lista)
		{
			$user->getUser($lista->idUser);
			echo "</br> <a href='?act=user-view-profile&view=$lista->idUser'> $user->getNick() </a>";
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
		$user = new User;
		foreach($matriz as $lista)
		{
			$user->getUser($lista->idUser);
			echo "</br> <a href='?act=user-view-profile&view=$lista->idUser'> $user->getNick() </a>";
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

?>
