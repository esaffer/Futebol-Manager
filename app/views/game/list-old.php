<h1>Lista de jogos que já ocorreram</h1>
<hr />
<?php
	$idTeam = $_POST['idTeam'];
	
	if($idTeam == "")
	{
		echo "Nenhum jogo antigo foi encontrado";
		return;
	}	
	
	$game = new Game;
	$lista = $game->getListTeamDateOld($idTeam,date('Y-m-d H:i:s',time()));

	if($lista == False)
	{
		echo "Nenhum jogo antigo foi encontrado";
		return;	
	}
	else{
		echo "</br> </br>Jogos realizados:</br>";
			foreach($lista as $id_game){
				echo "<a href='?act=game-view-profile&view=$id_game->id'>$id_game->date </a> </br>";
			}
	}
?>
