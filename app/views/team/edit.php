<h1>Editar Equipe</h1>

<?
	if ($_POST['idTeam'] == "") {
		echo "<br><br>É necessário informar o ID de uma equipe para editar!";
		return;
	}

	$team = new Team;
	$team->getTeam($_POST['idTeam']);
	
	if($team->getIDOwner() != $idUserFacebook) {
		echo "<br><br>Apenas o owner pode editar o time!";
		return;
	}
	
	if($_GET['do'] == 'change-owner') {
		//Deleta o novo owner da tabela de participantes do grupo
		$new_owner = new UserTeam;
		$new_owner->delete($_POST['new-owner'],$_POST['idTeam']);		
		
		//Coloca o antigo owner na tabela de users...
		$old_owner = new UserTeam;
		$old_owner->setIDUser($idUserFacebook);
		$old_owner->setIDTeam($_POST['idTeam']);
		$old_owner->setPoints(0);
		$old_owner->setLocked(False);
		$old_owner->setDateJoined();
		$old_owner->Add();
		
		//Coloca o novo owner no lugar...
		$team->setIDOwner($_POST['new-owner']);
		$team->Edit($_POST['idTeam']);
					
		
		//Cria warning
		$lista_ids = geraWarning($_POST['idTeam'],$_POST['new-owner']);
				
		$mensagem = "Um novo owner foi escolhido para o grupo <b>".$team->getName()."</b>";
		$notification = $facebook->api_client->notifications_send($lista_ids, $mensagem, 'app_to_user');
		
		//Fim-cria-warning
		
		echo "<br><br> Owner trocado com sucesso!";
		echo "<br><br><br><a href='?act=team-view-profile&view=".$_POST['idTeam']."'> Ver perfil do grupo <b>".$team->getName()."</b> </a>";
		return;
	}	
	
	if ($_GET['do'] == 'edit') {
		$team->setName($_POST['name']);
		$team->setPlace("");///
		$team->setRules($_POST['rules']);
		if ($_POST['privative'] == "true")
			$team->setPrivative(True);
		else
			$team->setPrivative(False);
			
		$team->setDescription($_POST['description']);
		$team->setDateCreated($_POST['date_created']);
		$team->setIDOwner($idUserFacebook);
		$team->setImage($_POST['image']);
		$team->Edit($_POST['idTeam']);
		
		echo "<br><br><br><a href='?act=team-view-profile&view=".$_POST['idTeam']."'> Ver perfil do grupo <b>".$_POST['name']."</b> </a>";
		return;
	}
	
	//Colocar isso numa coluna secundária...

	$userTeam = new UserTeam;
	$lista = $userTeam->getListTeam($_POST['idTeam']);
	
	if($lista == False){
		echo "<br><br> Não há nenhum membro disponível para se tornar owner!";
	}
	else {
		echo "<form action='?act=team-edit&do=change-owner' method='POST'>";
		
		foreach($lista as $aux)	{
			$user_aux = new User;
			$user_aux->getUser($aux->idUser);
			echo "<input type='radio' name='new-owner' value='$aux->idUser'>". $user_aux->getNick()." <br>";
		}
		echo "<input type='hidden' id='idTeam' name='idTeam' value='".$_POST['idTeam']."' />";
		echo "<input type='submit' value='Trocar owner' />";
		echo "</form>";
	}


?>
	<form action='?act=team-edit&do=edit' method='POST'>
		<br />
		<label for='name'>Nome:</label>
		<input type='text' id='name' name='name' value='<?= $team->getName() ?>' />
<!--		<br />
		<label for='local'>Local:</label>
		<input type='text' id='place' name='place' value='<?= $team->getPlace() ?>' /> -->
		<br /> 
		<label for='image'>Link da imagem:</label>
		<input type='text' id='image' name='image' value='<?= $team->getImageSrc() ?>' />
		<br />
		<label for='description'>Descrição:</label>
		<textarea id='description' name='description' ><?= $team->getDescription() ?></textarea>
		<br />
		<label for='rules'>Regras:</label>
		<textarea id='rules' name='rules' ><?= $team->getRules() ?></textarea>
		<br />
			<input type='radio' name='privative' value='false' <?= ($team->getPrivative() == False) ? 'checked' : '' ?>>Público</br>
			<input type='radio' name='privative' value='true' <?= ($team->getPrivative() == True) ? 'checked' : '' ?>>Privado</br>
		<br />
	     	<input type='hidden' id='date_created' name='data_created' value='<?=$team->getDateCreated()?>' />
		<input type='hidden' id='idTeam' name='idTeam' value='<?= $team->getID() ?>' />
		<input type='submit' value="Salvar Modificações" />
	</form>
	
	<form action='?act=team-delete' method='POST'>
		<input type='hidden' id='idTeam' name='idTeam' value='<?= $team->getID() ?>' />
		<input type='submit' value="Deletar grupo" />
	</form>
	
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
	
	$mensagem = "O usuário <b>".$user->getNick()."</b> foi promovido à owner do grupo <b>" . $team->getName() . "</b>";
	
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
