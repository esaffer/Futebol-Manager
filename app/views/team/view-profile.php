<h1>Profile da Equipe</h1>

<?php

	$idTeam = $_GET['view'];
	
	if($idTeam == "")
	{
		echo "Nenhum grupo selecionado!";
		return;
	}
		
	$team = new Team;
	$team->getTeam($idTeam);
	
	$userTeam = new UserTeam;
	$linha = $userTeam->getUserTeam($idUserFacebook,$idTeam);
	
	if($team->getPrivative() == TRUE && $team->getIDOwner() != $idUserFacebook && $linha == False)
	{
		echo "Desculpe, mas você não tem permissão de ver o perfil deste grupo";
		return;
	}
	
	//Usuário comum deixou o grupo
	if($_GET['do'] == 'leave' && $linha != False)
	{		
		$userTeam->delete($idUserFacebook,$idTeam);
		echo "<br><br> Você acabou de sair da equipe <b> ".$team->getName()." </b> <br><br><br>";
		echo "<a href='?act=user-view-profile&view=?$team->getID()'>Ver perfil do grupo <b>".$team->getName()." </b> </a>";	
		return;
	}
	
	//Usuário pediu um invite..
	if($_GET['do'] == 'invite' && $linha == False)
	{		
		$invite = new Invite;
		$invite->setIDInviter(0);
		$invite->setIDInvited($idUserFacebook);
		$invite->setIDTeam($idTeam);
		$invite->setStatus(False);
		$invite->setUserStatus(True);
		$invite->Add();	
	}	
?>

	<?= $team->getImage($idTeam); ?>
	<br />
	Nome: <?= $team->getName() ?>
	<br/>
	Data de cadastro: <?= date('Y-m-d H:i:s',$team->getDateCreated()) ?>
	<br />
	Nome do criador do grupo: 
	<?  
		$ownername = $team->getTeamOwnerName();
		$ownerid = $team->getIDOwner();
		echo "<a href='?act=user-view-profile&view=$ownerid'>$ownername</a>";
	?>
	<br />
	Tipo de grupo: <?= ($team->getPrivative() == True) ? 'Privado' : 'Publico' ?>
	<br />
	Descrição: <?= $team->getDescription() ?>
	<br />
	Regras: <?= $team->getRules() ?>
	<br />
	<br />
	<br />
	<? 
	

	
		$jogos = new Game;
		$matriz = $jogos->getListTeamDateNew($idTeam,date('Y-m-d H:i:s',time()));
		if($matriz == False) {
			echo "Este grupo ainda não marcou nenhum jogo</ br>";
		}
		else{
			echo "Jogos marcados:</br>";
			foreach($matriz as $id_game){
				echo "<a href='?act=game-view-profile&view=$id_game->id'>$id_game->date </a> </br>";
			}
		}
	?>
	<br>
	<?//Lista os Usuarios do grupo
		$userteam2 = new UserTeam;
		$membros = $userteam2->getListTeam($idTeam);
		
		$owner = new User;
		$owner->getUser($team->getIDOwner());		
		
		if ($membros == false){
			echo "Membros do grupo:<br>";
			echo "<a href='?act=user-view-profile&view=".$owner->getID() ."'> ". $owner->getImage($owner->getID()) . $owner->getNick() ."</a>";
		}
		else{	
			echo "Membros do grupo:<br>";
			foreach($membros as $id_membro){
				$user = new User;
				$user->getUser($id_membro->idUser);
				$nick = $user->getNick();
				$foto = $user->getImage($user->getID());
				echo "<a href='?act=user-view-profile&view=$id_membro->idUser'> $foto $nick </a>";
			}
			echo "<a href='?act=user-view-profile&view=".$owner->getID()."'> ". $owner->getImage($owner->getID()). $owner->getNick() ."</a>";
		}
	?>
	
	
	<?
	
	/*modo owner: ainda em testes.. favor nao deletar
	if($team->getIDOwner() == $idUserFacebook){
		//requisicoes
		$invite2 = new Invite();
		$requisicoes = $invite2->getListTeam($idTeam);
		
		if($requisicoes != False){
			foreach($requisicoes as $id_req){
				if($id_req->userStatus == true && $id_req->status != true){
					$invited = new User;
					$invited->getUser($id_req->idInvited);
					$nick = $invited->getNick();
					$foto = $invited->getImage($invited->getID());
					
					echo "<a href='?act=user-view-profile&view=$id_req->idInvited'> $foto $nick </a> 
					quer entrar no time";
					if($id_req->idInviter != 0){
						$inviter = new User;
						$inviter->getUser($id_req->idInviter);
						$nick2 = $inviter->getNick();
						echo "(o convite foi feito por 
						<a href='?act=user-view-profile&view=$id_req->idInviter'>$nick2 </a>";
					}
					?>
					
					<form action='?act=team-accept-reject' method='POST'>
					<input type='hidden' id='idTeam' name='idTeam' value='<?= $id_invite->idTeam ?>' />
					<input type='hidden' id='idInvite' name='idInvite' value='<?= $id_invite->id ?>' />
					<input type='hidden' id='status' name='status' value='true' />
					<input type='submit' value='Aceitar' />
					
				<?
				}
			}
		}
		else{
			echo "Não há requisições de ingresso pendentes";
		}
	}
	*/
	
	//Sair do grupo, apenas membros vêem isso... Método para sair do grupo...
	if($userTeam->getIDTeam() != "" &&  $team->getIDOwner() != $idUserFacebook)
	{
	?>
			<form action='?act=team-view-profile&view=<?= $team->getID()?>&do=leave' method='POST'>
				<input type='submit' value="Sair do grupo" />
			</form>
	<?
	}
	
	//Executa ações restrita a membros. Implementar tudo logo após	
	if( ($userTeam->getIDTeam() != "" && $userTeam->getLocked() == FALSE ) || $team->getIDOwner() == $idUserFacebook)
	{
	?>	
		<form action='?act=create-game' method='POST'>
			<input type='hidden' id='idTeam' name='idTeam' value='<?= $team->getID() ?>' />
			<input type='submit' value="Criar novo jogo" />
		</form>
		
		<form action='?act=invite-friends-team&id=<?= $team->getID()?>' method='POST'>
			<input type='hidden' id='idTeam' name='idTeam' value=" <?= $team->getID() ?>" />
			<input type='submit' value="Convidar um amigo para este grupo!" />
		</form>
	<?
	}	
	else
	{	
		$invite_test = new Invite;
		$invite_test->getInviteInvited($idUserFacebook,$idTeam);
		if($invite_test->getID() == "")//Não é owner e nem é do grupo e nem tem convite e nem recém pediu invite
		{
		?>
			<form action='?act=team-view-profile&view=<?= $team->getID()?>&do=invite' method='POST'>
				<input type='submit' value="Pedir convite" />
			</form>
		<?
		}
		else {
			echo "</br><b>Você está convidado para este time. Aguarde até que o dono do grupo o avalie </b> </br>";
		}
	}
	if($team->getIDOwner() == $idUserFacebook) //Apenas Owner vê isso aqui...
	{
	?>	
		<form action='?act=team-edit' method='POST'>
			<input type='hidden' id='idTeam' name='idTeam' value='<?= $team->getID() ?>' />
			<input type='submit' value="Editar grupo" />
		</form>
	<?
	}

?>
	<form action='?act=game-list-old' method='POST'>
			<input type='hidden' id='idTeam' name='idTeam' value='<?= $team->getID() ?>' />
			<input type='submit' value="Ver jogos passados" />
	</form>
