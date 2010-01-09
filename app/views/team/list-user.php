<h1>Seus Grupos</h1>

<?php
	$list_owner_team = new Team;
	$matriz = $list_owner_team->getListTeamOwner($idUserFacebook);
	if($matriz == False) {
		echo "Voce ainda nao é dono de nenhum grupo...< /br>";
		echo "<a href='?act=team-add'> Crie um grupo </a> agora mesmo!";
	}
	else{
		echo "Grupos de qual sou owner: </br>";
		foreach($matriz as $id_team){
				echo "<a href='?act=team-view-profile&view=$id_team->id'> $id_team->name </a> </br>";
		}
	}	
	
	$list_team = new UserTeam;
	$sql = $list_team->getListTeam($idUserFacebook);
	if($sql == False) {
		echo "Voce ainda não participa de nenhum grupo... </ br>";
		echo "<a href='?act=team-all'> Procure um grupo </a> agora mesmo!";
	}
	else{
		echo "Sou membro dos seguintes grupos:</br>";
		foreach($sql as $id_team){
			echo "<a href='?act=team-view-profile&view=$id_team->id'> $id_team->name </a> </br>";
		}
	}
?>
