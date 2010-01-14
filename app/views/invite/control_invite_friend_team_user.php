<?
	$status = FALSE;
	
	$team = new Team;
	$team->getTeam($_GET['id']);
	
	if($team->getIDOwner() == $idUserFacebook)
		$status = TRUE;
						
	if($_POST['ids'] != "") //Alguem foi convidado...
	{
			echo "Obrigado por convidar os seguintes amigos:<br />";
			$invite = new Invite;
			foreach($_POST['ids'] as $id) {
				$invite->setIDInviter($idUserFacebook);
				$invite->setIDInvited($id);
				$invite->setIDTeam($_GET['id']);
				$invite->setStatus($status);
				$invite->setUserStatus(False);
				$invite->Add();				
				
				$user = new User;
				$user->getUser($id);
				echo $user->getNick()." <br />";	
			}
	}
	else
	{
			//Imprime algo?
		echo "Nao convidou ninguem =( ";
	}
?>
?>
