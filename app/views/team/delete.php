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
		$team = new Team;
		$team->getTeam($_POST['idTeam']);
		
		//Envia as notificações
		$lista_ids = geraWarning($_POST['idTeam']);		
		$mensagem = "O grupo <b>".$team->getName()."</b>, na qual você participava, foi fechado";
		$notification = $facebook->api_client->notifications_send($lista_ids, $mensagem, 'app_to_user');
		//Fim do troço, continue deletando...
		
		$userTeam->deleteTeam($_POST['idTeam']);
		
		$userGame = new UserGame;
		$userGame->deleteTeam($_POST['idTeam']);
		
		$invite = new Invite;
		$invite->deleteTeam($_POST['idTeam']);		
		
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
?>

<?php
function geraWarning($idTeam)
{
	$team = new Team;
	$team->getTeam($idTeam);
	
	$alerta = new Warning;
	
	$userTeam = new UserTeam;
	$lista_users = $userTeam->getListTeam($idTeam);
		
	$mensagem = "O grupo <b>" . $team->getName() . "</b>, na qual você participava, foi fechado!</ br>";
	
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
