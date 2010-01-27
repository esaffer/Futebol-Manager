<h1>Confirmar ou Recusar requisição</h1>
<hr />
<?php
	$invite = new Invite;
	$invite->getInvite($_POST['idInvite']);
	
	
	if($_POST['idTeam'] == "" || $_POST['idUser'] == "")
	{
		echo "</ br> Nenhum time selecionado";
		return;
	}
	
	$team = new Team;
	$team->getTeam($_POST['idTeam']);	
	
	if($team->getIDOwner() != $idUserFacebook)
	{
		echo "</ br> Você não tem permissão para executar essa ação";
		return;
	}
	
	if($_POST['status'] == 'false')
	{
		$invite->delete($_POST['idInvite']);
		echo "A requisição foi rejeitada </ br>";
		echo "<a href='?act=home'> Voltar para tela inicial </a> </br>";
		return;
	}
	
	if($_POST['status'] == 'true')
	{
		if($invite->getUserStatus() == True )
		{
			$userteam = new UserTeam;			
			$userteam->setIDUser($invite->getIDInvited());
			$userteam->setIDTeam($_POST['idTeam']);
			$userteam->setLocked(False);
			$userteam->setDateJoined();
			$userteam->setPoints(0);
			$userteam->Add();
			$invite->delete($_POST['idInvite']);
			echo "O usuario foi adicionado ao grupo! </ br>";
			echo "<a href='?act=home'> Voltar para tela inicial </a> </br>";
			
			/*//PARTE DO ENVIO DO NEWSFEED
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
					$targetid = $invite->getIDInvited();
					$attachment = array( 
						'name' => 'Sport Manager',
						'href' => 'http://apps.facebook.com/futebolmanager/',
						'caption' => '', 
						'description' => "Comece a usar já o Sport Manager e marque jogos com sua turma!", 
						'properties' => '',
						'media' => array(array('type' => 'image', 'src' => 'http://knuth.ufpel.edu.br/tiago/media/img/logo-icon.png',
							'href' => 'http://apps.facebook.com/futebolmanager/'))
								);
					$attachment = json_encode($attachment);
					$facebook->api_client->stream_publish($title, $attachment, $targetid);
				}
			}	*/		
			
			return;
		}
		else
		{
			$invite->setStatus(1);
			$invite->Edit($_POST['idInvite']);
			echo "</ br> O usuário entrará no grupo assim que ele aceitar o convite!";
			return;
		}
	}
	

?>
<br><br><br>
