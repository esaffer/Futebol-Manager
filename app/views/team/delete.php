<h1>Deletar Equipe</h1>

<?
	if($_POST['idTeam'] == "")
	{
		echo "Grupo não encontrado";
		return;
	}
	
	$team = new Team;
	$team->getTeam($_POST['idTeam']);
	
	if($team->getIDOwner() != $idUserFacebook)
	{
		echo "Você não têm permissão para deletar o grupo";
		return;
	}
	
	if ($_GET['do'] == 'delete') 
	{
		echo "Executa a ação de deletar o time e tudo relacionado a ele...";
	}	
	else {
		echo "Tem certeza que deseja deletar o grupo '$team->getName()' ? </ br>";
		echo "<form action='?act=team-delete&do=delete' method='POST'>";
		echo "<input type='hidden' id='idTeam' name='idTeam' value=$team->getID() />";
		echo "<input type='submit' value='Sim!' />";
		echo "</form>";
		
		echo "<form action='?act=view-profile&view=$team->getID()' method='POST'>";
		echo "<input type='hidden' id='idTeam' name='idTeam' value=$team->getID() />";
		echo "<input type='submit' value='Sim!' />";
		echo "</form>"; 
	}
