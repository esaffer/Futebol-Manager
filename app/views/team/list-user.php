<h1>Seus Grupos</h1>

<?php
	$list_owner_team = new Team;
	$matriz = $list_owner_team->getListTeamOwner($idUserFacebook);
	if($matriz == False) {
		echo "Voce ainda nao eh dono de nenhum grupo...<br>
		Procure algum <a href='?act=team-all'> grupo publico</a> e seja feliz!";
	}
	else{
		foreach($matriz as $id_team1){
				echo "GRUPOS QUE VOCE EH OWNER:<br>$id_team1->name<br>";
		}
	}
	
	
	$list_team = new UserTeam;
	$sql = $list_team->getListTeam($idUserFacebook);
	if($sql == False) {
		echo "Voce ainda nao participa de nenhum grupo...<br>
		Procure algum <a href='?act=team-all'> grupo publico</a> e seja feliz!";
	}
	else{
		foreach($sql as $id_team){
			echo "$id_team->id<br>";
		}
	}
	
/*

/
	<?= $team->getImage($idTeam); ?>
<br />
	Nome: <?= $team->getName() ?>
<br/>
	Data de cadastro: <?= $team->getDateCreated() ?>
<br />
	Nome do criador do grupo: <?= $team->getTeamOwnerName() ?>
<br />
	Tipo de grupo: <?= ($team->getPrivative() == True) ? 'Privado' : 'Publico' ?>
<br />
	Descrição: <?= $team->getDescription() ?>
<br />
	Regras: <?= $team->getRules() ?>
<br />
	Jogos Marcados: (Fazer!)
<br />	
<?php
	//Executa ações restrita a membros. Implementar tudo logo após
	
	$userTeam = new UserTeam;
	$userTeam->getUserTeam($idUserFacebook,$idTeam);
	
	if( ($userTeam->getIDTeam() != "" && $userTeam->getLocked() == FALSE ) || $team->getIDOwner() == $idUserFacebook)
	{
	?>
		
		<form action='?act=create-game' method='POST'>
			<input type='hidden' id='idTeam' name='idTeam' value=" <? echo $team->getID() ?>" />
			<input type='submit' value="Criar novo jogo" />
		</form>
			
			<form action='?act=invite-friends-team&id=<?= $team->getID()?>' method='POST'>
			<input type='hidden' id='idTeam' name='idTeam' value=" <? echo $team->getID() ?>" />
			<input type='submit' value="Convidar um amigo para este grupo!" />
		</form>
	<?
	}
	else*/
	
	
?>
