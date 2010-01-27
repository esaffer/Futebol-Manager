<?
	$user = new User;
	$invite = new Invite;
	$convites = $invite->getListInvited($idUserFacebook);

	if ($convites != False)
	{
		foreach ($convites as $id_invite)
		{
			$team = new Team;
			$team->getTeam($id_invite->idTeam);
			echo "Você possuí um convite do time <a href='?act=team-view-profile&view=".$team->getID()."'>".$team->getName()." </a>";
			if ($id_invite->userStatus == true && $id_invite->status != true)
			{
				echo "aguardando a aceitação do owner do grupo </ br>";
			}
			else {
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
				<?
			}
		}
	}
?>
