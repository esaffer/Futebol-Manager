<h1>Página Inicial<br><br><br><br><br><br><br><br><br><br></h1>

<?php
	$user = new User;
	$invite = New Invite;
	$convites = $invite->getListInvited($idUserFacebook);
	
	echo "</ br>Seja bem vindo!";
	
	if($convites != False)
	{
		foreach($convites as $id_invite){
			$team = new Team;
			$team->getTeam($id_invite->idTeam);
			echo "Convites do time <a href='?act=team-view-profile&view=".$team->getID()."'>".$team->getName()." </a> </br>";
			?> 
			<form action='?act=invite-accept-reject' method='POST'>
				<input type='hidden' id='idTeam' name='idTeam' value='<?= $id_invite->idTeam ?>' />
				<input type='hidden' id='idInvite' name='idInvite' value='<?= $id_invite->id ?>' />
				<input type='hidden' id='status' name='status' value='true' />
				<input type='submit' value='Aceitar' />
			</form>
			<form action='?act=invite-accept-reject' method='POST'>
				<input type='hidden' id='idTeam' name='idTeam' value='<?= $id_invite->idTeam ?>' />
				<input type='hidden' id='idInvite' name='idInvite' value='<?= $id_invite->id ?>' />
				<input type='hidden' id='status' name='status' value='false' />
				<input type='submit' value='Rejeitar' />
			</form>
		<? } 
	

	}
	
	
?>
