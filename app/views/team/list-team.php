<h1>Lista de Grupos</h1>

<?php
	$teams = new Team;
	$sql = $teams->getListPublic();
	if($sql == False) {
		echo "Não há nenhum grupo público cadastrado!";
	}
	else{
		echo "Grupos: </br>";
		foreach($sql as $id_team){
				echo "<a href='?act=team-view-profile&view=$id_team->id'> $id_team->name </a> </br>";
		}
	}	
	
	$list_team = new UserTeam;
	$sql = $list_team->getListTeam($idUserFacebook);
	if($sql != False) {
		echo "Participo dos seguintes grupos:</br>";
		foreach($sql as $id_team){
			echo "<a href='?act=team-view-profile&view=$id_team->id'> $id_team->name </a> </br>";
		}
	}
	
	$userOwner = new Team;
	$sql = $userOwner->getListTeamOwner($idUserFacebook);
	if($sql != False) {
		echo "Sou o criador dos seguintes grupos:</br>";
		foreach($sql as $id_team){
			echo "<a href='?act=team-view-profile&view=$id_team->id'> $id_team->name </a> </br>";
		}
	}
?>
