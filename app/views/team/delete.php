<h1>Deletar Equipe</h1>

<?
	if($_POST['idTeam'] == "")
	{
		echo "Grupo não encontrado";
		return;
	}
	
	$team = new Team;
	$team->getTeam($_POST['idTeam']);
	
	if($team->getIDOwner() != $idUserFacebook)
	{
		echo "Você não têm permissão para deletar o grupo";
		return;
	}
	
	if ($_GET['do'] == 'delete') 
	{
		$userTeam = new UserTeam;
		$userTeam->deleteTeam($_POST['idTeam']);
		
		$userGame = new UserGame;
		$userGame->deleteTeam($_POST['idTeam']);
		
		$invite = new Invite;
		$invite->deleteTeam($_POST['idTeam']);
		
		$team = new Team;
		$team->delete($_POST['idTeam']);	
		
		$game = new Game;
		$game->deleteTeam($_POST['idTeam']);
		
		echo "<br><br>O grupo foi deletado com sucesso!";
		
		echo "<br><br><a href='?act=home'>Voltar à tela inicial</a>";	
	}	
	else {
		echo "Tem certeza que deseja deletar o grupo '".$team->getName()."' ? </ br>";
		echo "<form action='?act=team-delete&do=delete' method='POST'>";
		echo "<input type='hidden' id='idTeam' name='idTeam' value='".$team->getID()."' />";
		echo "<input type='submit' value='Sim!' />";
		echo "</form>";		
		echo "<br><br><a href='?act=team-view-profile&view=".$team->getID()."'>NÃOOOO. Tire-me daqui!!!!</a>";	
	}
