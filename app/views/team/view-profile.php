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
	
	$invite_test = new Invite;
	$gah = $invite_test->getInviteInvited($idUserFacebook);
	echo "teste";
	print_r($gah);

	//Usuário pediu um invite..
	if($_GET['do'] == 'invite' && $linha == False && $invite_test == False)
	{		
		$invite = new Invite;
		$invite->setIDInviter(0);
		$invite->setIDInvited($idUserFacebook);
		$invite->setIDTeam($idTeam);
		$invite->setStatus(False);
		$invite->setUserStatus(True);
		$invite->Add();	
		echo "</br> Seu pedido foi enviado. Aguarde até que o dono do grupo o avalie </br>";	
	}	
?>

	<?= $team->getImage($idTeam); ?>
	<br />
	Nome: <?= $team->getName() ?>
	<br/>
	Data de cadastro: <?= date('Y-m-d H:i:s',$team->getDateCreated()) ?>
	<br />
	Nome do criador do grupo: <?= $team->getTeamOwnerName() ?>
	<br />
	Tipo de grupo: <?= ($team->getPrivative() == True) ? 'Privado' : 'Publico' ?>
	<br />
	Descrição: <?= $team->getDescription() ?>
	<br />
	Regras: <?= $team->getRules() ?>
	<br />
	<? 
		$jogos = new Game;
		$matriz = $jogos->getListTeamOrderDateDesc($idTeam);
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
	<br />	
	<?

	//Executa ações restrita a membros. Implementar tudo logo após	
	if( ($userTeam->getIDTeam() != "" && $userTeam->getLocked() == FALSE ) || $team->getIDOwner() == $idUserFacebook)
	{
	?>
	
		<form action='?act=create-game' method='POST'>
			<input type='hidden' id='idTeam' name='idTeam' value=" <?= $team->getID() ?>" />
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
		if($invite_test == False && $team->getIDOwner() != $idUserFacebook)//Não é owner e nem é do grupo
		{
		?>
			<form action='?act=team-view-profile&view=<?= $team->getID()?>&do=invite' method='POST'>
				<input type='submit' value="Pedir convite" />
			</form>
		<?
		}
	}
?>
