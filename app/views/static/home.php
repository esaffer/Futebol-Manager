<h1>Página Inicial<br><br><br><br><br><br><br><br><br><br></h1>

<?php
	$user = new User;
	$invite = New Invite;
	$convites = $invite->getListInvited($idUserFacebook);
	
	echo "</ br>Seja bem vindo!<br><br>";
	
	if($convites != False)
	{
		foreach($convites as $id_invite){
			$team = new Team;
			$team->getTeam($id_invite->idTeam);
			echo "Convites do time <a href='?act=team-view-profile&view=".$team->getID()."'>".$team->getName()." </a> </br>";
			if($id_invite->userStatus == true){
				echo "aguardando a aceitação do owner do grupo";
			}
			else{
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
	$list_owner_team = new Team;
	$matriz = $list_owner_team->getListTeamOwner($idUserFacebook);
	if($matriz == False) {
		echo "Você nao é dono de nenhum grupo, portanto não possui requisições pendentes de ingresso em grupos";
	}
	else{
		foreach($matriz as $id_team){	
			//requisicoes
			$invite2 = new Invite();
			$requisicoes = $invite2->getListTeam($id_team->id);
			
			if($requisicoes != False){
				foreach($requisicoes as $id_req){
					if($id_req->userStatus == true && $id_req->status != true){
						$invited = new User;
						$invited->getUser($id_req->idInvited);
						$nick = $invited->getNick();
						$foto = $invited->getImage($invited->getID());
						
						echo "Requisições pendentes do grupo 
							<a href='?act=team-view-profile&view=$id_team->id'> $id_team->name </a> </br>";
						echo "<a href='?act=user-view-profile&view=$id_req->idInvited'> $foto $nick </a> 
						quer entrar no time";
						if($id_req->idInviter != 0){
							$inviter = new User;
							$inviter->getUser($id_req->idInviter);
							$nick2 = $inviter->getNick();
							echo "(o convite foi feito por 
							<a href='?act=user-view-profile&view=$id_req->idInviter'>$nick2</a>)";
						}
						?>
						<form action='?act=invite-owner-accept-reject' method='POST'>
						<input type='hidden' id='idTeam' name='idTeam' value='<?= $id_invite->idTeam ?>' />
						<input type='hidden' id='idInvite' name='idInvite' value='<?= $id_req->id ?>' />
						<input type='hidden' id='idUser' name='idUser' value='<?= $id_req->idInvited ?>' />
						<input type='hidden' id='status' name='status' value='true' />
						<input type='submit' value='Aceitar' />
						
						<form action='?act=invite-owner-accept-reject' method='POST'>
						<input type='hidden' id='idTeam' name='idTeam' value='<?= $id_invite->idTeam ?>' />
						<input type='hidden' id='idInvite' name='idInvite' value='<?= $id_req->id?>' />
						<input type='hidden' id='idUser' name='idUser' value='<?= $id_req->idInvited ?>' />
						<input type='hidden' id='status' name='status' value='false' />
						<input type='submit' value='Rejeitar' />
					<?
					}
				}
			}
		}
	}
	
	
?>
