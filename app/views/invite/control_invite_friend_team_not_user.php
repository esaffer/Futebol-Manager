<?
	$status = FALSE;
	
	$team = new Team;
	$team->getTeam($_GET['id']);
	
	if($team->getIDOwner() == $idUserFacebook)
		$status = TRUE;
						
	if($_POST['ids'] != "")
	{
		echo "Obrigado por convidar os seguintes amigos:<br />";
		$invite = new Invite;
		foreach($_POST['ids'] as $id) {
			$invite->setIDInviter($idUserFacebook);
			$invite->setIDInvited($id);
			$invite->setIDTeam($_GET['id']);
			$invite->setStatus($status);
			$invite->Add();				
			echo "<fb:name uid=". $id . " linked='true' /> <br />";	
		}	
	}
	else
	{
			//Imprime algo?
		echo "Nao convidou ninguem =( ";
	}
?>
