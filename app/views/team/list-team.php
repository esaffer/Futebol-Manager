<h1>Lista de Grupos</h1>
<hr />
<?php
	$teams = new Team;	
	
	echo "</ br>Procurar grupos </ br> </ br>";
	?>
	<form action="?act=team-all&do=search" method="POST">
		<label for='name'>Digite o nome do grupo:</label>
		<input type="text" id='name' name='name' />
		<input type='submit' value='Procurar'>
	<br />
	<?
	echo "<br> <br>";
	if($_GET['do'] == 'search' && $_POST['name'] != "")
	{
		$sql = $teams->getListSearch($_POST['name']);
		if($sql == False) {
			echo "Nenhum grupo corresponde à sua procura!";
		}
		else{
			echo "Grupos encontrados: </br>";
			foreach($sql as $id_team){
					echo "<a href='?act=team-view-profile&view=$id_team->id'> $id_team->name </a> </br>";
			}
		}
		echo "<br> <br>";	
	}
	else
	{
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
	}
	
	echo "<br> <br>";
	$list_team = new UserTeam;
	$sql = $list_team->getListTeam($idUserFacebook);
	if($sql != False) {
		echo "Participo dos seguintes grupos:</br>";
		foreach($sql as $id_team){
			echo "<a href='?act=team-view-profile&view=$id_team->id'> $id_team->name </a> </br>";
		}
	}
	
	echo "<br> <br>";
	$userOwner = new Team;
	$sql = $userOwner->getListTeamOwner($idUserFacebook);
	if($sql != False) {
		echo "Sou o criador dos seguintes grupos:</br>";
		foreach($sql as $id_team){
			echo "<a href='?act=team-view-profile&view=$id_team->id'> $id_team->name </a> </br>";
		}
	}
?>
