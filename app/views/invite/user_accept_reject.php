<?php
	$invite = new Invite;
	$invite->getInvite($_POST['idInvite']);
	if($_POST['status'] == 'true')
	{
		if($invite->getStatus() == true)
		{
			$userteam = new UserTeam;
			$userteam->setIDUser($idUserFacebook);
			$userteam->setIDTeam($_POST['idTeam']);
			$userteam->setLocked(False);
			$userteam->setDateJoined();
			$userteam->setPoints(0);
			$userteam->Add();
			
			$team = new Team;
			$team->getTeam($_POST['idTeam']);
			
			echo "Seja bem vindo(a) ao grupo ".$team->getName()."! </ br>";
			echo "<a href='team-view-profile&view=".$team->getID()."'> Ir ao perfil do grupo </a> </br>"; 
			$invite->delete($_POST['idInvite']);
			
			//PARTE DO ENVIO DO NEWSFEED
			if ($team->getPrivative() == False)
			{
				$has_permission = $facebook->api_client->users_hasAppPermission("publish_stream");
				if(!$has_permission)
				{
				     echo "<br /><fb:prompt-permission perms=\"publish_stream\"> Publique no seu NewsFeed! </fb:prompt-permission>";
				}
				else
				{
					$name_team = $team->getName();
					$title = "agora participa do grupo $name_team!";
					$attachment = array( 
						'name' => APP_NAME,
						'href' => 'http://apps.facebook.com/futebolmanager/',
						'caption' => '', 
						'description' => "Comece a usar já o Sport Manager e marque jogos com sua turma!", 
						'properties' => '',
						'media' => array(array('type' => 'image', 'src' => 'http://knuth.ufpel.edu.br/tiago/media/img/logo-icon.png',
							'href' => 'http://apps.facebook.com/futebolmanager/'))
								);
					$attachment = json_encode($attachment);
					$facebook->api_client->stream_publish($title, $attachment);
				}
			}
		}
		else
		{
			echo "Você aceitou o convite! </ br>";
			echo "Aguarde a aprovação do Owner do grupo </ br>";
			$invite->setUserStatus(1);
			$invite->Edit($_POST['idInvite']);
			echo "<a href='?act=home'> Voltar para tela inicial </a> </br>";
		}
	}
	else{
		$invite->delete($_POST['idInvite']);
		echo "<\ br>Seu convite foi deletado com sucesso!";
		echo "<\ br><a href='?act=home'> Voltar para tela inicial </a> </br>";
	}		

?>
<br><br><br>
